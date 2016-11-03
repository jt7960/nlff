<?php

class Nlff_model extends CI_Model{
            
            
    public function __construct()
        {
                $this->load->database();
        }
        
    public function create_league(){
        //this array is the data that will be used to create the league
        $league_data = array(
        'commissioner_id' => $this->input->post('commissioner_id'),
        'league_name' => $this->input->post('league_name'),
        'password' => $this->input->post('league_password'),
        'buffs' => $this->input->post('buffs'),
        'upgrades' => $this->input->post('upgrades'),
        'reserves' => $this->input->post('reserves'),
        'public' => $this->input->post('public')
            );
         //if the insert fails, return false and get out of here   
         if(!$this->db->insert('t_leagues', $league_data)){
             return FALSE;
            }
        //run a query to get the id of the league just created, couple that with the creator id, and insert a record into the t_users_leagues table
        $query = $this->db->query('SELECT MAX(league_id) as league_id FROM t_leagues WHERE commissioner_id = "'. $league_data['commissioner_id'].'"');
        $row = $query->row();
        echo $row->league_id;
        $user_league_data = array(
            'user_id' => $this->input->post('commissioner_id'),
            'league_id' => $row->league_id
        );
        //if creating hte t_users_leagues record fails return false and get out of here.
        //Also, handle what happens to the newly created league, delete it? what if we delete the wrong one?
        if(!$this->db->insert('t_users_leagues', $user_league_data)){
            return FALSE;
        }
    }


        function get_users_leagues($user_id){
        $leagues = array();
        $query = $this->db->query('SELECT league_id FROM t_users_leagues WHERE user_id = "'.$user_id.'"');
        foreach ($query->result_array() as $row){
            array_push($leagues, $row['league_id']);
        }
        return $leagues;
        }
}