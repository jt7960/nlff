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
        
        $data['javascript'] = array('jquery.js', 'bootstrap.js', 'auth.js', 'home.js');
        $data['css'] = array('main.css', 'bootstrap.css');

        $this->load->view('/common/header.php', $data);
        $this->load->view('/common/title_bar.php');
        $this->load->view('/common/login.php');
        //echo $this->ion_auth->logged_in(); //uncomment to see if you are logged in.
        $this->home();
        
        $this->load->view('/common/footer.php');
    }

    public function home(){
        if($this->ion_auth->logged_in()){$this->load->view('/nlff/user-home.php');}
        else{$this->load->view('/nlff/guest-home.php');}
    }

    
}