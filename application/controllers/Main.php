<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

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
		$this->headdata['title'] = 'Home - Growpartpicker';
		$this->titledata['heading'] = 'Welcome to Grow Part Picker';
		$this->contentdata['view'] = 'views/content/main/home.php';
		$this->contentdata['message'] = 'Complete Builds, Grow Guides, Parts, and More!';

		// View
		$this->load->one_column(
			$this->headdata,
			$this->headerdata,
			$this->navdata,
			$this->titledata,
			$this->contentdata
		);
	}

	public function about() {
		$this->headdata['title'] = 'About - Growpartpicker';
		$this->titledata['heading'] = 'About Grow Part Picker';
		$this->contentdata['view'] = 'views/content/main/about.php';

		// View
		$this->load->one_column(
			$this->headdata,
			$this->headerdata,
			$this->navdata,
			$this->titledata,
			$this->contentdata
		);
	}

	public function disclosure() {
		$this->headdata['title'] = 'Disclosure - Growpartpicker';
		$this->titledata['heading'] = 'Disclosure';
		$this->contentdata['view'] = 'views/content/main/disclosure.php';

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
