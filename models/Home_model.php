<?php

class Home_model extends CI_Model{
            
            
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
        return $user_league_data['league_id'];
    }


   function get_users_leagues($user_id){
        $leagues = array();
        $sql = "SELECT l.league_name as league_name, l.league_id as league_id FROM t_leagues as l JOIN t_users_leagues as ul ON l.league_id = ul.league_id WHERE ul.league_id IN
        (SELECT league_id FROM t_users_leagues WHERE user_id = ?)";
        $query = $this->db->query($sql, array($user_id));
        foreach ($query->result_array() as $row){
            array_push($leagues, array($row['league_id'] => $row['league_name']));
        }
        return $leagues;
        }

    public function get_league_members($league_id){
        $league_users = array();
        $sql = "SELECT user_id FROM t_users_leagues WHERE league_id = ?";
        $result = $this->db->query($sql, array($league_id));
        foreach ($result as $user_id){
            array_push($league_users, $user_id);
        }
        return $league_users;
    } 

    //this function made me realize that leagues will need to support mulitple commissioners and so the db needs to add the many to many table
    //also, the function to create a league needs to be modified to support this.
   public function get_league_commissioners($league_id){
        $league_commissioners = array();
        $sql = "SELECT commissioner_id FROM t_leagues_commissioners WHERE league_id = ?";
        $result = $this->db->query($sql, array($league_id));
        foreach($result as $commissioner){
            array_push($league_commissioners, $commissioner);
        }
        return $league_commissioners;
    }

}