<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->headdata = array();
		$this->headerdata = array();
		$this->navdata = array();
		$this->titledata = array();
		$this->sidebardata = array();
		$this->contentdata = array();
	}

	public function index() {
        $this->signin();
	}

	public function signin() {
		$this->headdata['title'] = 'Sign In - Growpartpicker';
		$this->titledata['heading'] = 'Sign In to Grow Part Picker';
		$this->contentdata['view'] = 'views/content/users/signin.php';

		// View
		$this->load->one_column(
			$this->headdata,
			$this->headerdata,
			$this->navdata,
			$this->titledata,
			$this->contentdata
		);
    }
    
    public function signup() {
		$this->headdata['title'] = 'Sign Up - Growpartpicker';
		$this->titledata['heading'] = 'Sign Up for Grow Part Picker';
		$this->contentdata['view'] = 'views/content/users/signup.php';

		// View
		$this->load->one_column(
			$this->headdata,
			$this->headerdata,
			$this->navdata,
			$this->titledata,
			$this->contentdata
		);
	}

	public function signout() {
		$this->headdata['title'] = 'Sign In - Growpartpicker';
		$this->titledata['heading'] = 'Sign Back In';
		$this->contentdata['view'] = 'views/content/users/signin.php';

		// View
		$this->load->one_column(
			$this->headdata,
			$this->headerdata,
			$this->navdata,
			$this->titledata,
			$this->contentdata
		);
	}
}
