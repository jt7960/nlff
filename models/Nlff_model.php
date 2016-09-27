<?php

class Nlff_model extends CI_Model{
            
            
    public function __construct()
        {
                $this->load->database();
        }
        
    public function create_league(){
        $data = array(
        'commissioner_id' => $this->post('commissioner_id'),
        'league_name' => $this->post('league_name'),
        'league_password' => $this->post('league_password'),
        'buffs' => $this->post('buffs'),
        'upgrades' => $this->post('upgrades'),
        'reserves' => $this->post('reserves')
            );
        return $this->db->insert('t_league', $data);
    }
}