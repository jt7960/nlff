<?php

class Nlff_model extends CI_Model{
            
            
    public function __construct()
        {
                $this->load->database();
        }
        
    public function create_league(){
        $data = array(
        'commissioner_id' => $this->input->post('commissioner_id'),
        'league_name' => $this->input->post('league_name'),
        'password' => $this->input->post('league_password'),
        'buffs' => $this->input->post('buffs'),
        'upgrades' => $this->input->post('upgrades'),
        'reserves' => $this->input->post('reserves'),
        'public' => $this->input->post('public')
            );
        return $this->db->insert('t_leagues', $data);
    }
    function get_users_leagues($user_id){
        $leagues = array();
        $query = $this->db->query('SELECT league_id FROM t_leagues WHERE commissioner_id = "'.$user_id.'"');
        foreach ($query->result_array() as $row){
            array_push($leagues, $row['league_id']);
        }
        return $leagues;
        }
}