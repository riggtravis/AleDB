<?php
class Community_Partner extends CI_controller {
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		// Load the test page just to see if it is loading anything.
		$this->load->view('test');
	}
};
