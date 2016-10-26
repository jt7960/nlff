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
        'league_password' => $this->input->post('league_password'),
        'buffs' => $this->input->post('buffs'),
        'upgrades' => $this->input->post('upgrades'),
        'reserves' => $this->input->post('reserves'),
        'public' => $this->input->post('public')
            );
        return $this->db->insert('t_leagues', $data);
    }
}