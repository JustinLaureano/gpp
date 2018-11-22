<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resources extends CI_Controller {

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
		$this->headdata['title'] = 'Resources - GrowPartPicker';
		$this->titledata['heading'] = 'Resources';
		$this->contentdata['view'] = 'views/content/resources/home.php';
		
		// View
		$this->load->two_column(
			$this->headdata,
			$this->headerdata,
			$this->navdata,
			$this->titledata,
			$this->sidebardata,
			$this->contentdata
		);
	}
}
