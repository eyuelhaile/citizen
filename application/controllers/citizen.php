<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Citizen extends CI_Controller {
	/**
	*/
	public function index(){
	    $this->load->helper('common_helper');
	    $this->load->library('session');
	    $this->load->view('templates/citizen_header');
		$this->load->view('citizen/index');
	    $this->load->view('templates/footer');
	}
	

}