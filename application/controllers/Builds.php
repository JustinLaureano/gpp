<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Builds extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->headdata = array();
		$this->headerdata = array();
		$this->navdata = array();
		$this->titledata = array();
		$this->sidebardata = array();
		$this->contentdata = array();
	}

	public function index($permalink = NULL) {
        if ($permalink) {
            $this->view_build($permalink);
        }
        else {
            $this->view_build_list();
        }
	}

	private function view_build($permalink) {
		$this->headdata['title'] = 'Build - GrowPartPicker';
		$this->titledata['heading'] = 'Part List';
		$this->contentdata['view'] = 'views/content/builds/view_build.php';
		$this->contentdata['message'] = 'Single Build';
		
		// View
		$this->load->one_column(
			$this->headdata,
			$this->headerdata,
			$this->navdata,
			$this->titledata,
			$this->contentdata
		);
    }
    
    private function view_build_list() {
		$this->headdata['title'] = 'Build List - Growpartpicker';
		$this->titledata['heading'] = 'Build List';
		$this->contentdata['view'] = 'views/content/builds/view_build_list.php';
		$this->contentdata['message'] = 'Build List Items go here';
		
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
