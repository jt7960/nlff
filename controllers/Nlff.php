<?php

class Nlff extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Nlff_model');
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
        if($this->form_validation->run() == FALSE)
            {
                $this->load->view('templates/header.php', $data);
                $this->load->view('nlff/register_user.php');
                $this->load->view('templates/footer.php', $data);
            }
        else
        {  
            $this->Nlff_model->register_user();
            $this->load->view('templates/header.php', $data);
            $this->load->view('nlff/register_user_success.php');
            $this->load->view('templates/footer.php', $data);       
        }
    }
}