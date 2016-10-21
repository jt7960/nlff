<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Nlff_model');
        $this->load->model('User_model');
        $this->load->helper('url');
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
    }

   public function user_status(){ //perhaps this could be extracted by data to a view, but why? **Moved BACK! suck it Trebek** (how else can I dynamically change the login to logout on the fly?!?!)
        $this->load->view('common/user_status');
    }

    public function login(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        echo $_POST['remember_me'];
        if($this->form_validation->run() == FALSE){
            return FALSE;
        }
        else{
            echo 'ran validation';
            if($_POST['remember_me'] == 'true'){$remember_me = TRUE;}
            if($_POST['remember_me'] == 'false'){$remember_me =  FALSE;}
            $this->ion_auth->login($_POST['username'], $_POST['password'], $remember_me);
            return TRUE;
        }
    }

    public function register(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('verify', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
        $this->form_validation->set_rules('username', 'Username', 'callback_username_check');
        print_r($_POST);

        if($this->form_validation->run() == FALSE){
            $this->load->view('common/register');
            return FALSE;
        }
        else{
            echo 'validation ran';
            $this->ion_auth->register($_POST['username'], $_POST['password'], $_POST['email']);
            header("Location: " . base_url());
            $this->login();
            return TRUE;
        }
    }

    public function username_check($username){
        $this->db->where('username', $username);
        $this->db->from('users');
        if ($this->db->count_all_results() > 0){
            $this->form_validation->set_message('username_check', 'The username ' . $username . 'is already taken');
            return FALSE;
            }
            else{
                return TRUE;
            }
        }

    public function email_check($email){
        $this->db->where('email', $email);
        $this->db->from('users');
        if ($this->db->count_all_results() > 0){
            $this->form_validation->set_message('email_check', 'The email address ' . $email . 'is already registered. Did you <a href="users/password_reset">forget your password?</a>');
            return FALSE;
            }
            else{
                return TRUE;
            }
        }

    public function logout(){
        $this->ion_auth->logout();
    }

}