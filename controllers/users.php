<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->load->model('Home_model');
        $this->load->model('User_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
        
    }

   public function user_status(){ 
        $this->load->view('common/user_status');
    }

    public function login(){
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        //echo $_POST['remember_me'];
        if($this->form_validation->run() == FALSE){
            echo 'You probably left a field blank or something.';
        }
        else{
            if($_POST['remember_me'] == 'true'){$remember_me = TRUE;}
            if($_POST['remember_me'] == 'false'){$remember_me =  FALSE;}
            $this->ion_auth->login($_POST['username'], $_POST['password'], $remember_me);
            if($this->ion_auth->logged_in()){
                echo 'true';
            }
            else{
                echo validation_errors();
            }

            
        }
    }

    public function register(){
        $this->form_validation->set_message('username_check', 'The username ' . $username . 'is already taken');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('verify', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
        $this->form_validation->set_rules('username', 'Username', 'callback_username_check');
        $this->form_validation->set_message('email_check', 'The email address ' . $email . 'is already registered. Did you <a href="users/password_reset">forget your password?</a>');
        if($this->form_validation->run() == FALSE){
            echo 'You probably left a field blank or something.';
        }
        else{
            if($this->ion_auth->register($_POST['username'], $_POST['password'], $_POST['email']) == FALSE){
                echo validation_errors();
            }
            else{
                echo 'true';
                $this->ion_auth->login($_POST['username'], $_POST['password'], FALSE);
            }
        }
    }

    public function username_check($username){
        $this->db->where('username', $username);
        $this->db->from('users');
        if ($this->db->count_all_results() > 0){

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