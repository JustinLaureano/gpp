<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('item_subcategory_model');
		
		$this->headdata = array();
		$this->headerdata = array();
		$this->navdata = array();
		$this->titledata = array();
		$this->sidebardata = array();
		$this->contentdata = array();
	}

	public function index($subcategory = NULL) {
        if ($subcategory) {
            $this->view_subcategory($subcategory);
        }
        else {
            $this->view_category_list();
        }
	}

	private function view_subcategory($subcategory) {
		// Find Subcategory by the url name
		$itemsubcategory = $this->item_subcategory_model->select_by_urlname($subcategory);


		$this->headdata['title'] = 'Category - GrowPartPicker';
		$this->titledata['heading'] = 'Category';
		$this->contentdata['view'] = 'views/content/products/view_category.php';
		$this->contentdata['message'] = $itemsubcategory;
		$this->contentdata['subcategory'] = $subcategory;
		
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
    
    private function view_category_list() {
		$this->headdata['title'] = 'Product Categories - GrowPartPicker';
		$this->titledata['heading'] = 'Category List';
		$this->contentdata['view'] = 'views/content/products/view_category_list.php';
		$this->contentdata['message'] = 'List of all product categories to link to individual category';
		
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
