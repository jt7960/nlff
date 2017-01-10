<?php

class League_model extends CI_Model{

    public function __construct(){
            $this->load->database();
    }
    public function league_exists($league_id){
        $sql = 'SELECT COUNT(*) FROM t_leagues WHERE league_id = ?';
        $result = $this->db->query($sql);
    }
    public function get_league_members($league_id){
        $league_users = array();
        $sql = "SELECT user_id FROM t_teams WHERE league_id = ?";
        $result = $this->db->query($sql, array($league_id));
        foreach ($result as $user_id){
            array_push($league_users, $user_id);
        }
        return $league_users;
    }
    public function get_open_draft_positions($league_id){
        $available_draft_positions = array();
        $sql = "SELECT num_teams FROM t_leagues WHERE league_Id = ?";
        $query = $this->db->query($sql, $league_id);
        $row = $query->row();
        $num_teams = $row->num_teams;
        for($i = 1; $i<=$num_teams; $i++){
            $posible_draft_positions[$i]=$i;
        }
        $taken_draft_positions = array();
        $sql = "SELECT draft_position FROM t_teams WHERE league_id = ?";
        $query = $this->db->query($sql, $league_id);
        foreach($query->result_array() as $result){
            $taken_draft_positions[$result['draft_position']] = $result['draft_position'];
        }
        return array_diff($posible_draft_positions, $taken_draft_positions);
    }
    public function get_league_commissioners($league_id){
        $league_commissioners = array();
        $sql = "SELECT user_id FROM t_teams WHERE commissioner = '1' AND league_id = ?";
        $query= $this->db->query($sql, array($league_id));
        foreach($query->result_array() as $commissioner){
            array_push($league_commissioners, $commissioner);
        }
        return $league_commissioners;
    }
    public function get_league_data($league_id){
        $sql = "SELECT * FROM t_leagues WHERE league_id = ?";
        $query = $this->db->query($sql, $league_id);
        return $query->row();
    }
    public function join_public_league($array){
        //print_r($array);
        //first query to be sure if the draft position is still available
        $where_array = array('league_id'=>$array['league_id'], 'draft_position'=>$array['draft_position']);
        $this->db->where($where_array);
        $number = $this->db->count_all_results('t_teams');
        echo $number; 
        if($number > 0){
            return array(false, 'The draft position was already chosen for this league, try again');
        }
        //create record for the new team in the league in the db
        $sql = 'INSERT INTO t_teams (user_id, league_id, team_name, draft_position, commissioner, team_icon) VALUES (?,?,?,?,?,?)';
        if($this->db->query($sql, array($array['user_id'], $array['league_id'], $array['team_name'], $array['draft_position'], '0', $array['team_icon'])) ==false){
            return array(false, "Not exactly sure what happened, but I failed to join the league. My bad, try again.");    
        }
        return array(true, "Welcome to League: " . $array['league_id']);



    }
    public function join_private_league($array){
        $sql = 'INSERT INTO t_teams (user_id, league_id, team_name, draft_position, commissioner) VALUES (?,?,?,?,?)';
        return ($this->db->query($sql, array($array['user_id'], $array['league_id'], 'unnamed team', $array['draft_position'], '0')));
    }
    public function check_private_league_credentials($array){
        $league_id = $array['league_id'];
        $password = $array['password'];
        $this->db->where(array('league_id'=>$league_id, 'password'=>$password));
        if($this->db->count_all_results('t_leagues') == '1'){
            return true;
        }
        else{
            return false;
        }
    }
}

?>