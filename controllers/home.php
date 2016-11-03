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

    
}