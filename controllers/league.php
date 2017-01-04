<?php defined('BASEPATH') OR exit('No direct script access allowed');

class League extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
    }

    public function index(){
        
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
            $data['leagues'] = $this->Home_model->get_users_leagues($user->id);
        }
        $this->load->view('/common/header.php', $data);
        $this->load->view('/common/title_bar.php');
        $this->load->view('/common/login.php');
        $data['identity'] = ''; //we want to know who is logged in, left blank for now
        $data['title'] = 'Player List';
        $data['user_id'] = '';
        
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->view('/league/players.php', $data);
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

    public function open_leagues(){
        if($_POST){
            //print_r($_POST);
            $league_id = $_POST['league_id'];
            $league_password = $_POST['league_password'];
            $matching_leagues = $this->Home_model->join_league($league_id, $league_password);
            echo $matching_leagues;

            }
        $data['title'] = 'Join A League';
        $data['open_leagues'] = $this->Home_model->get_open_leagues();
        $this->load->view('/common/header.php', $data);
        $this->load->view('/common/title_bar.php');
        $this->load->view('/home/open_leagues.php');
        $this->load->view('/common/footer.php');
    }

    public function join_league($league_id){
        $data['league_id'] = $league_id;
        if($_POST){
            $team_name = $_POST['team_name'];
            $draft_position = $_POST['draft_position'];
            $team_icon = $_POST['team_icon'];
            
        }
        $this->load->view('/common/header.php', $data);
        $this->load->view('/common/title_bar.php');
        $this->load->view('/league/join_league.php');
        $this->load->view('/common/footer.php');
    }

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