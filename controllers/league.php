<?php defined('BASEPATH') OR exit('No direct script access allowed');

class League extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->model('User_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
    }

    public function home($id){
        $this->id = $id;
        //verify the user is in the league
            $league_users = $this->Home_model->get_league_members($id);
        //check if the user is the commish
            $league_commissioners = $this->Home_model->get_league_commissioners($id);
    }

    public function players(){
        $data['leagues'] = array();
        if($this->ion_auth->logged_in()){
            $user = $this->ion_auth->user()->row();
            $data['leagues'] = $this->Nlff_model->get_users_leagues($user->id);
        }
        $this->load->view('/common/header.php', $data);
        $this->load->view('/common/title_bar.php');
        $this->load->view('/common/login.php');
        $data['identity'] = ''; //we want to know who is logged in, left blank for now
        $data['title'] = 'Player List';
        $data['user_id'] = '';
        
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->view('/nlff/players.php', $data);
        $this->load->view('/common/footer.php');
    }


}