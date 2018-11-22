<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_subcategory_model extends CI_Model {

    public function select_by_urlname($urlname) {
        $this->db->select('*');
		$this->db->from('itemsubcategories');
		$this->db->where('urlname', $urlname);
        $query = $this->db->get();
        $data = $query->row_array();
        return $data;
    }

    public function select_by_id($id) {
        $this->db->select('*');
		$this->db->from('itemsubcategories');
		$this->db->where('id', $id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
}