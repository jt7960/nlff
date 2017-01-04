<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
        $this->form_validation->set_rules('username', 'User Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if($_POST){     
            if($_POST['form_name'] == 'login'){
                //print_r($_POST);
                if($this->form_validation->run() == true){
                    if ($_POST['remember_me'] == 'TRUE'){
                        $remember_me = TRUE;
                    }
                    else{
                        $remember_me = FALSE;
                    }
                    $this->ion_auth->login($_POST['username'], $_POST['password'], $remember_me);
                }
            }
            if($_POST['form_name'] == 'register'){
                $this->form_validation->set_rules('verify', 'Verify Password', 'required|matches[password]');
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('verify_email', 'Verify Email', 'required|matches[email]');
                if($this->form_validation->run() == true){
                    $this->ion_auth->register($_POST['username'], $_POST['password'], $_POST['email']);
                    $this->ion_auth->login($_POST['username'], $_POST['password'], true);

                }
            }
            }
        }
        
    

    //Site Pages
    public function index(){
        $data['leagues'] = array();        
        $this->load->view('/common/header.php', $data);
        $this->load->view('/common/title_bar.php');
        $this->load->view('/common/login.php');
        $this->load->view('/home/home.php');
        $this->load->view('/common/footer.php');
    }

    //form validation


}