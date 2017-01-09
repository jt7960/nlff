<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->load->model('Home_model');
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
        $this->form_validation->set_rules('username', 'User Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if($this->form_validation->run() == true){
                /*if ($_POST['remember_me'] == 'TRUE'){
                    $remember_me = TRUE;
                }
                else{
                    $remember_me = FALSE;
                }*/
                $this->ion_auth->login($_POST['username'], $_POST['password'], $_POST['remember_me']);
            }
        if(!$this->ion_auth->logged_in()){
            echo validation_errors();
        }
    }

    public function register(){
        $this->form_validation->set_rules('password','Password', 'required');
        $this->form_validation->set_rules('verify_password', 'Verify Password', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('verify_email', 'Verify Email', 'required|matches[email]');
        if($this->form_validation->run() == false){
            echo validation_errors();
        }
        else{
            if(!$this->ion_auth->register($_POST['username'], $_POST['password'], $_POST['email'])){
                echo $this->db->error_message();
            }
            if(!$this->ion_auth->login($_POST['username'], $_POST['password'], true)){
                echo $this->db->error_message();
            }
            echo validation_errors();   
        }
        
    }

    public function username_check($username){
        $this->db->where('username', $username);
        $this->db->from('users');
        if ($this->db->count_all_results() > 0){
            $this->form_validation->set_message('username_check', 'The username ' . $_POST['username']. 'is already taken');
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
            $this->form_validation->set_message('email_check', 'The email address ' . $_POST['email'] . 'is already registered. Did you <a href="users/password_reset">forget your password?</a>');
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