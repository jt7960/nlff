<?php defined('BASEPATH') OR exit('No direct script access allowed');
//What is the best way to set the league_id? configure it in the constructor? how? 
class League extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->model('League_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
        if(!$this->ion_auth->logged_in()){
            redirect('/');
        }
        else{
            $this->user = $this->ion_auth->user()->row();
        }
    }
    public function index(){
        redirect('/');
    }
    public function home($league_id){
        $league_data = $this->League_model->get_league_data($league_id);
        $team_data = $this->League_model->get_team_data($league_id, $this->user->id);
        $data['league_data'] = $league_data;
        $data['team_data'] = $team_data;
        $this->redirect_bad_league_ids($league_id);
        $this->load->view('common/header.php');
        $this->load->view('common/title_bar.php');
        $this->load->view('league/home.php', $data);
        $this->load->view('common/footer.php');
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
        if (file_exists($target_file)) {
            $message = "Sorry, file already exists.";
            $uploadOk = 0;
        }
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
            if (move_uploaded_file($file["team_icon"]["tmp_name"], $target_file)){
                $message =  "The file ". basename( $file["team_icon"]["name"]). " has been uploaded.";
                return array(true, $target_file);
            }
            else{
                return array(false, "Sorry, there was an error uploading your file.");
            }
        }
    }
    private function redirect_bad_league_ids($league_id){
        if(!isset($league_id) || !$this->League_model->league_exists($league_id)){
            redirect('/');
        }
    }


}//end of class