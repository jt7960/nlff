<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Nlff_model');
        $this->load->model('User_model');
        $this->load->helper('url');
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
    }

    public function index(){
        if($this->ion_auth->logged_in()){
            $user = $this->ion_auth->user()->row();
            $data['user_link'] = "Welcome <a href='/user/".$user->id.">".$user->username."</a>";
            $data['auth_link'] = "<a href='/nlff/logout'>Log Out</a>";
        }
        else{
            $data['user_link'] = "<a href='/user/register_user'>Register New Account</a>";
            $data['auth_link'] = "<a href=/user/login'>Log In</a>";
        }
        
        $this->load->view('/templates/header.php');
        $this->load->view('title_bar.php', $data);


    }
}