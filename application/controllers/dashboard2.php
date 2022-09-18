<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard2 extends CI_Controller {
	/**
	*/
	public function index(){
	    $this->load->helper('common_helper');
	    $this->load->library('session');
	    $data['session'] = $this->session->all_userdata();
	    $this->load->model('Link');
	    $data['menu'] = $this->Link->fetch_menu();
	    
	    $this->load->view('templates/header', $data);
		$this->load->view('dashboard2/index');
	    $this->load->view('templates/footer');
	}
	public function check_status()
	{
		try 
		{
			$this->load->library('session');
            $id = $this->session->userdata('id');
			$sql = "SELECT status
						FROM citizen where id = '$id'";
			$result = $this->db->query($sql);
			$return_data = $result->result(); 

			$data = array();
			$single = array();

			foreach($return_data as $key => $value) 
			{	
				$single['status'] = $value->status;
			}

            $data = $single;
			$data['success'] = true;
			die(json_encode($data));
		} 
		catch (Exception $e) 
		{

		}
	}

}