<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$this->signin();
	}

	public function signin()
	{
		$user = $this->input->post('user');
		$pass = $this->input->post('pass');

		if ($user != '' && $pass != '') {
			$this->load->model('users_model');
			$db_user = $this->users_model->get_user_by_username($user);

			if ($db_user['username'] == $user && password_verify($pass, $db_user['password'])) {
				$success = $db_user['fullname'] . ' Has Been Logged in Successfully.';
				$this->users_model->set_user_sessions($db_user);
				$this->dashboard($success);
			}
			else {
				$data = array(
					'loginfail' => 'Please enter a correct Username and Password.'
				);
				$this->load->template('login', ['loginfail' => $data, 'db_user' => $db_user]);
			}
		}
		else {
			$this->load->template('login');
		}
	}

	public function signout()
	{	
		$data = array(
			'message' => 'You are logged out.'
		);
		$this->load->model('users_model');
		$this->users_model->unset_user_sessions();
		$this->load->template('login', ['message' => $data]);
	}

	public function dashboard($success = null)
	{
		$this->load->library('functions');
		$rights = $this->functions->check_access_rights();
		if ($rights == false || $rights == 'candidate') {
			$this->load->template('login');
		}
		else if (isset($success)) {
			$this->load->admin_template('admin/dashboard', ['success' => $success]);
		}
		else {
			$this->load->admin_template('admin/dashboard');
		}
		
	}
}