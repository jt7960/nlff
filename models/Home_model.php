<?php

class Home_model extends CI_Model{
            
            
    public function __construct()
        {
                $this->load->database();
        }

    
    public function create_team($array){
        $this->db->insert('t_teams', $array);
    }
    public function generate_public_team_name(){
        $adjective = array('terrible', 'horrible', 'awful', 'smelly', 'yucky', 'awesome', 'holy');
        $verb = array('farting', 'clamoring', 'barfing', 'losing');
        $noun = array('suckers', 'idiots', 'losers', 'winners', 'fantasizers');
        //logic to pick one of each, concatonate the 3, and return the result.
    }
    public function generate_league_id(){
        while(true){
            $league_id = rand(10000000000, 99999999999);
            $this->db->where('league_id', $league_id);
            if ($this->db->count_all_results('t_leagues') == 0){
                return $league_id;
                    }
                }
    }
    public function create_league(){
        //this array is the data that will be used to create the league
        $league_data = array(
        'league_id' => $this->generate_league_id(),
        'creator_id' => $this->input->post('creator_id'),
        'league_name' => $this->input->post('league_name'),
        'password' => $this->input->post('league_password'),
        'buffs' => $this->input->post('buffs'),
        'upgrades' => $this->input->post('upgrades'),
        'reserves' => $this->input->post('reserves'),
        'public' => $this->input->post('public'),
        'num_teams' => $this->input->post('num_teams'),
        'draft_date'=> strtotime($this->input->post('draft_date') . " " . $this->input->post('draft_time') . ' GMT')
            );
        //this array is the data for the t_team insert
        $team_data = array(
        'user_id' =>$league_data['creator_id'],
        'team_name' => 'unnamed team',
        'league_id' => $league_data['league_id'],
        'draft_position' => '1',
        'commissioner' => '1'
        );
        //create the t_league record
        $this->db->insert('t_leagues', $league_data);
        //create the t_team record
        $this->create_team($team_data);
        return $league_data['league_id'];
    }
    public function get_users_leagues($user_id){
        $leagues = array();
        $sql = "SELECT l.league_id, l.league_name FROM t_leagues l JOIN t_teams t ON l.league_id = t.league_id WHERE t.user_id = ?";
        $query = $this->db->query($sql, array($user_id));
        foreach ($query->result_array() as $row){
            array_push($leagues, array($row['league_id'] => $row['league_name']));
        }
        return $leagues;
    }
    public function get_open_leagues(){
        $user = $this->ion_auth->user()->row();
        $now = time();
        $sql = ('SELECT * FROM `v_open_leagues` ol JOIN t_teams t ON ol.league_id = t.league_id WHERE t.user_id NOT IN (?) AND ol.draft_date > "'.$now.'" GROUP BY ol.league_id');
        $query = $this->db->query($sql, array($user->id));
        return $query->result();
    }
    public function join_league($league_id, $password){
        //look at generate_league_id() for a better way to do this.....
        $user = $this->ion_auth->user()->row();
        $sql = "SELECT COUNT(*) as leagues FROM t_leagues l JOIN t_teams t ON l.league_id = t.league_id WHERE l.league_id = ? AND l.password = ? AND user_id NOT IN (?)";
        $query = $this->db->query($sql, array($league_id, $password, $user->id));
        $row = $query->row();
        return $row->leagues;
    }

//Business Rules
//A user can only be the founder of 1 public league
    public function get_users_public_leagues_count($user_id){
        $this->db->where('user_id', $user_id);
        $this->db->where('public', '1');
        $this->db->from('t_leagues');
        if($this->db->count_all_results() > 1){
            return FALSE;
        }
        else{
            return TRUE;
        }
    }     

}