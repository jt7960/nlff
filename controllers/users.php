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
        $this->form_validation->set_rules('email', 'User Email', 'required|valid_email');
        echo $_POST['remember_me'];
        if($this->form_validation->run() == FALSE){
            //$this->load->view('user/login.php');
            echo 'did not run validation';
            return FALSE;
        }
        else{
            echo 'ran validation';
            if($_POST['remember_me'] == 'true'){$remember_me = TRUE;}
            if($_POST['remember_me'] == 'false'){$remember_me =  FALSE;}
            $this->ion_auth->login($_POST['email'], $_POST['password'], $remember_me);
            return TRUE;
        }
    }

    public function register(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('verify', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'User Email', 'required|valid_email');
        print_r($_POST);

        if($this->form_validation->run() == FALSE){
            echo "validation did not run";
            return FALSE;
        }
        else{
            echo 'validation ran';
            $this->ion_auth->register($_POST['username'], $_POST['password'], $_POST['email']);
            return TRUE;
        }
    }

    public function username_check($str){
        if ($str == 'test'){
            $this->form_validation->set_message('username_check', 'The {field} field can not be the word "test"');
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