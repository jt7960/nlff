<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Nlff_model');
        $this->load->model('User_model');
        $this->load->helper('url');
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
    }

    public function user_status(){ //perhaps this could be extracted by data to a view, but why?
        if($this->ion_auth->logged_in()){
            echo "<a href='users/".$username."'>".$username."</a>";
        }
        else{
            echo "<a href='users/signin'>Sign In</a> / <a href='users/register'>Register</a>";
        }
    }

}