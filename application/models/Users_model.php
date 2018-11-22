<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{
    public function select_all()
    {
        $query = $this->db->query('SELECT * FROM users');
        $data = $query->result();
        return $data;
    }

    public function create($input)
    {
        $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
        $input['cancel'] = 0;
        $input['createdat'] = date('Y-m-d H:i:s');
        unset($input['confirmpassword']);

        $query = $this->db->insert('users', $input);
        if ($query) {
            $success_msg = 'User Added Successfully.';
            return $success_msg;
        }
        else {
            $errors = ['error' => 'User Not Added Successfully.'];
            $this->load->admin_template('admin/add_user', ['errors' => $errors, 'input' => $input]);
        }
    }

    public function update($input)
    {   
        if (isset($input['password'])) {
            $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
        }

        $this->db->set($input);
        $this->db->where('id', $input['id']);
        $query = $this->db->update('users');

        if ($query) {
            $success_msg = 'User Updated Successfully.';
            return $success_msg;
        }
        else {
            $errors = ['error' => 'User Not Updated Successfully.'];
            $this->load->admin_template('admin/edit_user', ['errors' => $errors, 'input' => $input]);
        }
    }

    public function get_user_by_id($userid)
    {   
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('users.id', $userid);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_user_by_username($username)
    {
        $this->db->select('id, username, password, fullname, userrights');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('cancel = 0');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function set_user_sessions($user)
    {
        $_SESSION['userid'] = $user['id'];
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['userrights'] = $user['userrights'];
    }

    public function unset_user_sessions()
    {
        unset(
            $_SESSION['userid'],
            $_SESSION['fullname'],
            $_SESSION['userrights']
        );
    }

    public function delete_user($userid)
    {
        $this->db->set('cancel', 1);
        $this->db->set('canceldate', date('Y-m-d H:i:s'));
        $this->db->set('canceluserid', $_SESSION['userid']);
        $this->db->where('id', $userid);
        $query = $this->db->update('users');

        if ($query) {
            $success_msg = 'User Deleted Successfully.';
            return $success_msg;
        }
        else {
            $error = 'User Not Deleted Successfully.';
            return $error;
        }
    }
}