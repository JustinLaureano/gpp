<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidates_model extends CI_Model
{
    public function select_all()
    {
        $this->db->select('*');
		$this->db->from('candidates');
		$this->db->where('cancel', 0);
        $query = $this->db->get();
        $data = $query->result();
        return $data;
    }

    public function select_active()
    {
		$this->db->select('id, name');
		$this->db->from('candidates');
		$this->db->where('cancel', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function candidate_by_id($id)
    {
        $this->db->select('*');
		$this->db->from('candidates');
		$this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function create($input)
    {
        $this->load->library('functions');
        $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
        $input['imageurl'] = $this->functions->name_to_lower($input['name']) . '.jpg';
        $input['cancel'] = 0;
        $input['createdat'] = date('Y-m-d H:i:s');
        $input['userrights'] = 'candidate';
        unset($input['confirmpassword']);
        unset($input['candidateimage']);

        $query = $this->db->insert('candidates', $input);
        if ($query) {
            $success_msg = 'Candidate Added Successfully.';
            return $success_msg;
        }
        else {
            $errors = ['error' => 'Candidate Not Added Successfully.'];
            $this->load->admin_template('admin/add_candidate', ['errors' => $errors, 'input' => $input]);
        }
    }

    public function update($candidate)
    {
        $this->db->set($candidate);
        $this->db->where('id', $candidate['id']);
        $query = $this->db->update('candidates');

        if ($query) {
            $success_msg = 'Candidate Updated Successfully.';
            return $success_msg;
        }
        else {
            $errors = ['error' => 'Candidate not Updated Successfully.'];
            $this->load->admin_template('admin/edit_candidate/' . $candidate['id'], ['errors' => $errors, 'input' => $input]);
        }

    }

    public function get_candidate_events($id)
    {
        $this->db->select('*');
		$this->db->from('events');
		$this->db->where('candidateid', $id);
		$this->db->order_by('eventstart', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_candidate($candidateid)
    {
        $this->db->set('cancel', 1);
        $this->db->set('canceldate', date('Y-m-d H:i:s'));
        $this->db->set('canceluserid', $_SESSION['userid']);
        $this->db->where('id', $candidateid);
        $query = $this->db->update('candidates');

        if ($query) {
            $success_msg = 'Candidate Deleted Successfully.';
            return $success_msg;
        }
        else {
            $error = 'Candidate Not Deleted Successfully.';
            return $error;
        }
    }

}