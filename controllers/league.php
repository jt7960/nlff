<?php defined('BASEPATH') OR exit('No direct script access allowed');

class League extends CI_Controller {
    
    public function __construct(){

    }

    public function home($id){
        $this->id = $id;
        //verify the user is in the league
            $league_users = $this->Nlff_model->get_league_users($id);
        //check if the user is the commish
            $league_commissioners = $this->Nlff_modle->get_league_commissioners($id);
    }





}