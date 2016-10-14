<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Nlff extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Nlff_model');
        $this->load->model('User_model');
        $this->load->helper('url');
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
    }
    
    public function index(){
        $data['css'] = '../assets/css/main.css'; 
        $data['javascript'] = '../assets/javascript/main.js';//i imagine this could be an array of files if needed
        $data['title'] = 'Next Level Fantasy Football';
        $this->load->view('templates/header.php', $data);
        $this->load->view('nlff/index.php', $data);
        $this->load->view('templates/footer.php', $data);
    }
    
    public function create_league(){
        $data['css'] = '../assets/css/main.css'; 
        $data['javascript'] = '../assets/javascript/main.js';//i imagine this could be an array of files if needed
        $data['identity'] = ''; //we want to know who is logged in, left blank for now
        $data['title'] = 'Create a New League';
        $data['user_id'] = '';
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('league_name', 'League Name', 'required');
        if($_POST){
            if($_POST['league_password'] != ''){
            $this->form_validation->set_rules('verify_league_password', 'Verify Password', 'required|matches[league_password]');
            $this->form_validation->set_rules('league_password', 'Password', 'required');
                }
            }
        
        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/header.php', $data);
            $this->load->view('nlff/create_league.php');
            $this->load->view('templates/footer.php', $data);
        }
        else
        {  
            $this->Nlff_model->create_league();
            $this->load->view('templates/header.php', $data);
            $this->load->view('nlff/create_league_success.php');
            $this->load->view('templates/footer.php', $data);       
        }
        

    }

    public function register_user(){
        $data['css'] = '../assets/css/main.css'; 
        $data['javascript'] = '../assets/javascript/main.js';//i imagine this could be an array of files if needed
        $data['title'] = 'Register';
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('user_password', 'Password', 'required');
        $this->form_validation->set_rules('verify_user_password', 'Verify Password', 'required|matches[user_password]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        //print_r($_POST);
        if($this->form_validation->run() == FALSE)
            {
                $this->load->view('templates/header.php', $data);
                $this->load->view('nlff/register_user.php');
                $this->load->view('templates/footer.php', $data);
            }
        else
        {  
            //QUESTION! Does CodeIgniter have a better way to access form-submitted values than using $_POST['']?????
            $username = $_POST['user_name'];
            $password = $_POST['user_password'];
            $email = $_POST['email'];
            if($this->ion_auth->register($username, $password, $email)){
                echo 'registered!';
            }
            else{
                echo 'not registered =(';
            }
            //$this->load->view('templates/header.php', $data);
            //$this->load->view('nlff/register_user_success.php');
            //$this->load->view('templates/footer.php', $data);       
        }
    
    public function login(){
        $data['css'] = '../assets/css/main.css'; 
        $data['javascript'] = '../assets/javascript/main.js';//i imagine this could be an array of files if needed
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_password', 'Password', 'required');
        $this->form_validation->set_rules('user_email', 'User Email', 'required|valid_email');
        
        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header.php', $data);
            $this->load->view('nlff/login.php');
            $this->load->view('templates/footer.php', $data);  
        }
        else{
            if($_POST['remember_me'] == 'true'){$remember_me = TRUE;}
            if($_POST['remember_me'] == 'false'){$remember_me =  FALSE;}
            if($this->ion_auth->login($_POST['user_email'], $_POST['user_password'], $remember_me)){
                echo 'logged in';
            }
            else{ echo 'not logged in';}
            //$this->load->view('templates/header.php', $data);
            //$this->load->view('nlff/');
            //$this->load->view('templates/footer.php', $data);  
        }
    }

}