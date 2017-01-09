<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
        }
        
    //Site Pages
    public function index(){
        $data['leagues'] = array();        
        $this->load->view('/common/header.php', $data);
        $this->load->view('/common/title_bar.php');
        $this->load->view('/common/login.php');
        $this->load->view('/home/home.php');
        $this->load->view('/common/footer.php');
    }
    public function open_leagues(){
        if($_POST){
            //print_r($_POST);
            $league_id = $_POST['league_id'];
            $league_password = $_POST['league_password'];
            $matching_leagues = $this->League_model->join_league($league_id, $league_password);
            echo $matching_leagues;

            }
        $data['title'] = 'Join A League';
        $data['open_leagues'] = $this->Home_model->get_open_leagues();
        $this->load->view('/common/header.php', $data);
        $this->load->view('/common/title_bar.php');
        $this->load->view('/home/open_leagues.php');
        $this->load->view('/common/footer.php');
    }
    public function create_league(){
        $data['title'] = 'Create a New League';

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
    public function join_league($league_id){
        $this->load->model('League_model');
        $data['title'] = 'Join League';
        $data['open_draft_positions'] = $this->League_model->get_open_draft_positions($league_id);
        $data['error_message'] = '';
        $league_data['league_data'] = $this->League_model->get_league_data($league_id);
        $user = $this->ion_auth->user()->row();
        
        
        if($_POST){
            //form validation
            $this->form_validation->set_rules('team_name', 'Team Name', 'required');       

            if($this->form_validation->run() == FALSE){
                $this->load->view('/common/header.php', $data);
                $this->load->view('/common/title_bar.php');
                $this->load->view('/league/join_league.php', $league_data);
                $this->load->view('/common/footer.php');
            }
            else{
                //turn post into variables
                $team_name = $_POST['team_name'];
                $draft_position = $_POST['draft_position'];
                //handle the team icon upload
                if($_FILES['team_icon']['size'] !== 0){
                    $upload_status = $this->upload_team_icon($_FILES);
                }
                else{
                    $upload_status = array(true, '');
                }
                
                if($upload_status[0] == false){
                    $this->load->view('/common/header.php', $data);
                    $this->load->view('/common/title_bar.php');
                    $this->load->view('/league/join_league.php', $league_data);
                    $this->load->view('/common/footer.php');
                }
                else{
                //put the variables into an array to send to the model  
                $join_data_array['league_id'] = $league_id;
                $join_data_array['team_name'] = $team_name;
                $join_data_array['draft_position'] = $draft_position;
                $join_data_array['team_icon'] = $upload_status[1];
                $join_data_array['user_id'] = $user->id;
                //print_r($join_data_array);
                $join_league_status = $this->League_model->join_league($join_data_array);
                    if($join_league_status[0] == true ){
                    redirect('/league/home/'.$league_id, 'refresh');
                    }
                    else{
                    $league_data['error message'] = $join_league_status[1];
                    $this->load->view('/common/header.php', $data);
                    $this->load->view('/common/title_bar.php');
                    $this->load->view('/league/join_league.php', $league_data);
                    $this->load->view('/common/footer.php');
                    }
                }
            }
        }
        else{
            $this->load->view('/common/header.php', $data);
            $this->load->view('/common/title_bar.php');
            $this->load->view('/league/join_league.php', $league_data);
            $this->load->view('/common/footer.php');
        }   
    }



    //form validation


}