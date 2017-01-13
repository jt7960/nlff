<!--TO do 
    DONE! update file upload function to rename files when they are uploaded, instead of denying duplicate file namespace
    DONE! add code to check for, and make sure a user cannot join the same league twice
    DONE! make it so a user can only be in 10 leagues
    Clean up the join league function, add a tracking variable and only out put the view at the end of the if/else logic, not multiple times

-->

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->model('League_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
        }
        
    //Site Pages
    public function index(){
        $data['leagues'] = array();
        $data['num_leagues'] = '';
        if($this->ion_auth->logged_in()){
            $user = $this->ion_auth->user()->row();
            $data['leagues'] = $this->Home_model->get_users_leagues($user->id);
            $data['num_leagues'] = $this->Home_model->get_users_league_count($user->id); 
        }
        $this->load->view('/common/header.php', $data);
        $this->load->view('/common/title_bar.php');
        $this->load->view('/common/login.php');
        $this->load->view('/home/home.php');
        $this->load->view('/common/footer.php');
    }
    public function create_league(){
        $user = $this->ion_auth->user()->row();
        if($this->Home_model->get_users_league_count($user->id) > 9){
            redirect('/');
        }
        
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
    public function load_join_league_form(){
        if($_POST && $this->League_model->check_league_credentials(array('league_id'=>$_POST['league_id'], 'password'=>$_POST['password']))){
            $data['league_data'] = $this->League_model->get_league_data($_POST['league_id']);
            $data['open_draft_positions'] = $this->League_model->get_open_draft_positions($_POST['league_id']);    
            $this->load->view('home/join_league_form', $data);
        }
    }
    //begin redo join league attempt block
    public function join_league(){
        
        if(!$this->ion_auth->logged_in()){
            redirect('/');
        }
        else{
            $user = $this->ion_auth->user()->row();
        }
        if($this->Home_model->get_users_league_count($user->id) > 9){
            redirect('/');
        }
        $user = $this->ion_auth->user()->row();
        $user_id = $user->id;   
        $data['open_leagues'] = $this->Home_model->get_open_leagues();
        $data['error'] = '';
        $data['title'] = 'Join League';
        if($_POST){
            //form validation
            $this->form_validation->set_rules('team_name', 'Team Name', 'required');  
            $league_id = $_POST['league_id'];
            $team_name = $_POST['team_name'];
            $draft_position = $_POST['draft_position'];
            if($this->form_validation->run() == FALSE){
                $this->load->view('/common/header.php');
                $this->load->view('/common/title_bar.php');
                $this->load->view('/home/join_league.php', $data);
                $this->load->view('/common/footer.php');
            }
            else{
                //handle the team icon upload
                if($_FILES['team_icon']['size'] !== 0){ //if the file size is bigger than 0, in other words, if a file was selected in the form
                    $upload_status = $this->upload_team_icon($_FILES); //$upload status is what was returned by the function to upload the file
                }
                else{
                    $upload_status = array(true, ''); //no file was chosen, allow the form to go through, enter '' into database
                }
                
                if($upload_status[0] == false){ //if the file upload function returned false, somthing went wrong
                    $data['error'] = $upload_status[1];
                    $this->load->view('/common/header.php');
                    $this->load->view('/common/title_bar.php');
                    $this->load->view('/home/join_league.php', $data);
                    $this->load->view('/common/footer.php');
                }
                else{
                //put the variables into an array to send to the model  
                $join_data_array['league_id'] = $league_id;
                $join_data_array['team_name'] = $team_name;
                $join_data_array['draft_position'] = $draft_position;
                $join_data_array['team_icon'] = $upload_status[1];
                $join_data_array['user_id'] = $user->id;
                //Make sure the user isn't already in the league
                if($this->Home_model->user_is_in_league( $league_id, $user_id)){
                    $data['error'] = "You are already in this league";
                }
                $join_league_status = $this->Home_model->join_league($join_data_array);
                    if($join_league_status[0] == true ){
                    redirect('/league/'.$league_id, 'refresh');
                    }
                    else{
                    $data['error'] = $join_league_status[1];
                    $this->load->view('/common/header.php');
                    $this->load->view('/common/title_bar.php');
                    $this->load->view('/home/join_league.php', $data);
                    $this->load->view('/common/footer.php');
                    }
                }
            }
        }
        else{
            $this->load->view('/common/header.php');
            $this->load->view('/common/title_bar.php');
            $this->load->view('/home/join_league.php', $data);
            $this->load->view('/common/footer.php');
        }
    }
    //end redo join league attempt block
    
    //form validation
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

    //other functions

    private function upload_team_icon($file){
        $target_dir = "uploads/team_icons/";
        $target_file = $target_dir . basename($file["team_icon"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        
        // Check if image file is a actual image or fake image
        $check = getimagesize($file["team_icon"]["tmp_name"]);
        if($check !== false){
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } 
        else{
            $message = "File is not an image.";
            $uploadOk = 0;
        }
        // Check if file already exists
        /*if (file_exists($target_file)) {
            //I need to find a way to rename the file instead of crashing here.
            $message = "Sorry, file already exists.";
            $uploadOk = 0;
        }*/
        // Check file size
        if ($file["team_icon"]["size"] > 500000) {
            $message = "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $message =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return array(false, "Sorry, your file was not uploaded." . $message);
        // if everything is ok, try to upload file
        }
        else{
            $file_exists = true;
            while($file_exists == true){
                $rand = rand(0, 10000000);
                $file_name = $target_dir . $rand .'.'. $imageFileType;
                if(!file_exists($file_name)){
                    if (move_uploaded_file($file["team_icon"]["tmp_name"], $file_name)){
                    $message =  "The file ". basename( $file["team_icon"]["name"]). " has been uploaded.";
                    return array(true, $file_name);
                }
                else{
                    return array(false, "There was an error uploading your file.");
                }
                    $file_exists == false;
                }
                else{
                    $file_exists == true;
                }
            }
            
        }
    }

    


}