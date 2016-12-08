<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Nlff_model');
        $this->load->model('User_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
    }

    public function index(){
        $data['leagues'] = array();
        if($this->ion_auth->logged_in()){
            $user = $this->ion_auth->user()->row();
            $data['leagues'] = $this->Nlff_model->get_users_leagues($user->id);
        }
        $data['javascript'] = array('jquery.js', 'bootstrap.js', 'auth.js', 'home.js');
        $data['css'] = array('main.css', 'bootstrap.css');
        

        $this->load->view('/common/header.php', $data);
        $this->load->view('/common/title_bar.php');
        $this->load->view('/common/login.php');
        //echo $this->ion_auth->logged_in(); //uncomment to see if you are logged in.
        $this->load->view('/nlff/home.php');
        $this->load->view('/parts/users_leagues.php', $data);
        $this->load->view('/common/footer.php');
    }

    public function home(){
        $this->load->view('/nlff/home.php');
    }

    public function create_league(){
        $data['javascript'] = array('jquery.js', 'bootstrap.js', 'auth.js');
        $data['css'] = array('main.css', 'bootstrap.css');
        $this->load->view('/common/header.php', $data);
        $this->load->view('/common/title_bar.php');
        $this->load->view('/common/login.php');
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
            $this->load->view('common/header.php', $data);
            $this->load->view('nlff/create_league.php');
            $this->load->view('common/footer.php', $data);
        }
        else
        {
            $league_id = $this->Nlff_model->create_league();   
            if(!$league_id){
                $this->load->view('common/header.php', $data);
                $this->load->view('nlff/create_league.php');
                $this->load->view('common/footer.php', $data);
            }
            else{
                redirect('/league/home/'.$league_id, 'refresh');
            }
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
                $data['javascript'] = array('jquery.js', 'bootstrap.js', 'home.js');
                $data['css'] = array('main.css', 'bootstrap.css');  
               
                $this->load->view('common/header.php', $data);
                $this->load->view('/common/title_bar.php');
                $this->load->view('nlff/register_user.php');
                $this->load->view('common/footer.php', $data);
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
            //$this->load->view('common/header.php', $data);
            //$this->load->view('nlff/register_user_success.php');
            //$this->load->view('common/footer.php', $data);       
        }
    }
    
    public function login(){
        $data['css'] = '../assets/css/main.css'; 
        $data['javascript'] = '../assets/javascript/main.js';//i imagine this could be an array of files if needed
        $data['title'] = 'Next Level Fantasy Football';
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_password', 'Password', 'required');
        $this->form_validation->set_rules('user_email', 'User Email', 'required|valid_email');
        
        if($this->form_validation->run() == FALSE){
            $this->load->view('common/header.php', $data);
            $this->load->view('nlff/login.php');
            $this->load->view('common/footer.php', $data);  
        }
        else{
            if($_POST['remember_me'] == 'true'){$remember_me = TRUE;}
            if($_POST['remember_me'] == 'false'){$remember_me =  FALSE;}
            if($this->ion_auth->login($_POST['user_email'], $_POST['user_password'], $remember_me)){
                echo 'logged in';
            }
            else{ echo 'not logged in';}
            //$this->load->view('common/header.php', $data);
            //$this->load->view('nlff/');
            //$this->load->view('common/footer.php', $data);  
        }
    }

}