<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Nlff extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Nlff_model');
        $this->load->model('User_model');
        $this->load->helper('url');
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
        
        if($this->form_validation->run() == FALSE)
            {
                $this->load->view('templates/header.php', $data);
                $this->load->view('nlff/register_user.php');
                $this->load->view('templates/footer.php', $data);
            }
        else
        {  
            $this->user_model->register_user();
            $this->load->view('templates/header.php', $data);
            $this->load->view('nlff/register_user_success.php');
            $this->load->view('templates/footer.php', $data);       
        }
    }
    
    public function login(){
        $this->load->helper(array('form'));
        $this->load->view('nlff/login.php');
    }
    
    public function validate_login(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('user_name', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
        
        if($this->form_validation->run() == FALSE){
            $this->load->view('nlff/login');
        }
        else{
            redirect('nlff/home', 'refresh');
        }
    }
    
    public function check_database($password){
        //Field validation succeeded.  Validate against database
        $username = $this->input->post('username');
        
        //query the database
        $result = $this->user_model->login($username, $password);
        
        if($result)
        {
            $sess_array = array();
            foreach($result as $row)
            {
            $sess_array = array(
                'id' => $row->id,
                'username' => $row->username
            );
            $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }

}