<?php

class Nlff extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
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
        
        $this->load->view('templates/header.php', $data);
        $this->load->view('nlff/create_league.php');
        $this->load->view('templates/footer.php', $data);
    }
}