<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->headdata = array();
		$this->headerdata = array();
		$this->navdata = array();
		$this->titledata = array();
		$this->sidebardata = array();
		$this->contentdata = array();
	}

	public function index($product_id = NULL) {
        if ($product_id) {
            $this->view_product($product_id);
        }
        else {
            $this->view_home();
        }
	}

	private function view_product($product_id) {
		$this->headdata['title'] = 'Product - GrowPartPicker';
		$this->titledata['heading'] = 'Product';
		$this->contentdata['view'] = 'views/content/product/view_product.php';
		$this->contentdata['message'] = 'Product Overview here';
		
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
    
    private function view_home() {
        //Todo - Link to home
	}
}
