<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->model('User_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
        
        //$this->Home_model->test();
    }
    //Site Pages
    public function index(){
        $data['leagues'] = array();
        if($this->ion_auth->logged_in()){
            $user = $this->ion_auth->user()->row();
            $data['leagues'] = $this->Home_model->get_users_leagues($user->id);
        }
        

        $this->load->view('/common/header.php', $data);
        $this->load->view('/common/title_bar.php');
        $this->load->view('/common/login.php');
        //echo $this->ion_auth->logged_in(); //uncomment to see if you are logged in.
        $this->load->view('/home/home.php');
        $this->load->view('/common/footer.php');
    }

    public function create_league(){
        $data['title'] = 'Create a New League';
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        if($_POST){ //if a the form was submitted
            //print_r($_POST);
            //set rules
            $this->form_validation->set_rules('draft_date', 'Draft Date', 'required|callback_draft_date_is_in_the_future');
            $this->form_validation->set_rules('draft_time', 'Draft Time', 'required');

            if($_POST['public'] == '0'){ //form submitted, and this is a private league, set some additional rules
                $this->form_validation->set_rules('verify_league_password', 'Verify Password', 'required|matches[league_password]');
                $this->form_validation->set_rules('league_password', 'Password', 'required');
                $this->form_validation->set_rules('league_name', 'League Name', 'required');
                }
            if($this->form_validation->run() == FALSE){ //form submitted, form validation failed, reload the page
                $this->load->view('common/header.php', $data);
                $this->load->view('common/title_bar.php');
                $this->load->view('home/create_league.php');
                $this->load->view('common/footer.php');
                }
            else{ //if the form was submitted and validation passed
                $league_id = $this->Home_model->create_league();
                redirect('/league/home/'.$league_id, 'refresh');
                }
            }
        else{ //form not submitted, load the page
            $this->load->view('common/header.php', $data);
            $this->load->view('common/title_bar.php');
            $this->load->view('home/create_league.php');
            $this->load->view('common/footer.php');
            }   
    }

    public function join_league(){
        $data['title'] = 'Join A League';
        $this->load->view('/common/header.php', $data);
        $this->load->view('/common/title_bar.php');
        $this->load->view('/home/join_league.php');
        $this->load->view('/common/footer.php');
    }

    //MODALS
    public function register_user(){
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
                $this->load->view('home/register_user.php');
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
            //$this->load->view('home/register_user_success.php');
            //$this->load->view('common/footer.php', $data);       
        }
    }
    
    public function login(){
        $data['title'] = 'Next Level Fantasy Football';
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_password', 'Password', 'required');
        $this->form_validation->set_rules('user_email', 'User Email', 'required|valid_email');
        
        if($this->form_validation->run() == FALSE){
            $this->load->view('common/header.php', $data);
            $this->load->view('home/login.php');
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
            //$this->load->view('home/');
            //$this->load->view('common/footer.php', $data);  
        }
    }

    //form validation
    public function draft_date_is_in_the_future($draft_date){
        $now = getdate();
        $timestamp = strtotime($draft_date);
        if($timestamp < $now[0]){
            $this->form_validation->set_message('draft_date_is_in_the_future', 'Draft Date must be in the future');
            return false;
        }
        //another condition should go here to verify the draft date is within the range of valid draft dates for a given season
        else{
            return true;
        }
        
    }

}