<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Politicalparties_model extends CI_Model
{
    public function get_all()
    {
        $this->db->select('name');
        $this->db->from('politicalparties');
        $query = $this->db->get();
        return $query->result_array();
    }
}