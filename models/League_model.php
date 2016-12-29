<?php

class League_model extends CI_Model{

    public function __construct()
        {
            $this->load->database();
        }

    public function league_exists($league_id){
        $sql = 'SELECT COUNT(*) FROM t_leagues WHERE league_id = ?';
        $result = $this->db->query($sql);
    }

}

?>