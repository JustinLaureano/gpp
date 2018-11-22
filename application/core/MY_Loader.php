<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader {

    public function one_column(
        $headdata = ['title' => 'GrowPartPicker'],
        $headerdata = array(),
        $navdata = array(), 
        $titledata = array(), 
        $contentdata = array(), 
        $return = FALSE
    ) {
        if ($return) {
            $content  = $this->view('includes/head', ['headdata' => $headdata], $return);
            $content .= $this->view('includes/header', ['headerdata' => $headerdata], $return);
            $content .= $this->view('includes/navigation', ['navdata' => $navdata], $return);
            $content .= $this->view('includes/title', ['titledata' => $titledata], $return);
            $content .= $this->view('includes/contents', ['contentdata' => $contentdata], $return);
            $content .= $this->view('includes/footer', '', $return);
            return $content;
        } 
        else {
            $this->view('includes/head', ['headdata' => $headdata]);
            $this->view('includes/header', ['headerdata' => $headerdata]);
            $this->view('includes/navigation', ['navdata' => $navdata]);
            $this->view('includes/title', ['titledata' => $titledata]);
            $this->view('includes/contents', ['contentdata' => $contentdata]);
            $this->view('includes/footer');
        }
    }

    public function two_column(
        $headdata = ['title' => 'GrowPartPicker'],
        $headerdata = array(),
        $navdata = array(), 
        $titledata = array(), 
        $sidebardata = array(), 
        $contentdata = array(), 
        $return = FALSE
    ) {
        if ($return) {
            $content  = $this->view('includes/head', ['headdata' => $headdata], $return);
            $content .= $this->view('includes/header', ['headerdata' => $headerdata], $return);
            $content .= $this->view('includes/navigation', ['navdata' => $navdata], $return);
            $content .= $this->view('includes/title', ['titledata' => $titledata], $return);
            $content .= $this->view('includes/sidebar', ['sidebardata' => $sidebardata], $return);
            $content .= $this->view('includes/contents', ['contentdata' => $contentdata], $return);
            $content .= $this->view('includes/footer', '', $return);
            return $content;
        } 
        else {
            $this->view('includes/head', ['headdata' => $headdata]);
            $this->view('includes/header', ['headerdata' => $headerdata]);
            $this->view('includes/navigation', ['navdata' => $navdata]);
            $this->view('includes/title', ['titledata' => $titledata]);
            $this->view('includes/sidebar', ['sidebardata' => $sidebardata]);
            $this->view('includes/contents', ['contentdata' => $contentdata]);
            $this->view('includes/footer');
        }
    }
}
