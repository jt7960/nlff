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

    public function user_status(){ //perhaps this could be extracted by data to a view, but why?
        if($this->ion_auth->logged_in()){
            echo "<a href='users/".$username."'>".$username."</a>";
        }
        else{
            echo "<a href='users/login' id='sign_in_link'>Sign In</a> / <a href='users/register' id='register_link'>Register</a>";
        }
    }

    public function login(){
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_password', 'Password', 'required');
        $this->form_validation->set_rules('user_email', 'User Email', 'required|valid_email');
        
        if($this->form_validation->run() == FALSE){
            //$this->load->view('user/login.php');
            return FALSE;
        }
        else{
            echo 'run validation true';
            if($_POST['remember_me'] == 'true'){$remember_me = TRUE;}
            if($_POST['remember_me'] == 'false'){$remember_me =  FALSE;}
            $this->ion_auth->login($_POST['user_email'], $_POST['user_password'], $remember_me);
            return TRUE;
        }
    }

    public function register(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_password', 'Password', 'required');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[user_password]');
        $this->form_validation->set_rules('user_email', 'User Email', 'required|valid_email');

        if($this->form_validation->run() == FALSE){
            return FALSE;
        }
        else{
            $this->ion_auth->register($_POST['username'], $_POST['password'], $_POST['email']);
            return TRUE;
        }


    }

}