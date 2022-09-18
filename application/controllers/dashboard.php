<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	/**
	*/
	public function index(){
	    $this->load->helper('common_helper');
	    $this->load->library('session');
	    $data['session'] = $this->session->all_userdata();
	    $this->load->model('Link');
	    $data['menu'] = $this->Link->fetch_menu();

	    $sql = "SELECT COUNT(CASE WHEN STATUS = 'Approved' THEN 1 END) AS approved,
                      COUNT(CASE WHEN STATUS = 'Pending' THEN 1 END) AS pending,
                      COUNT(CASE WHEN STATUS = 'Denied' THEN 1 END) AS denied,
                      COUNT(id) AS total
               FROM `citizen` ";
		$result = $this->db->query($sql);
		$return_data = $result->result();
		$data['approved'] = $return_data[0]->approved;
		$data['pending'] = $return_data[0]->pending;
		$data['denied'] = $return_data[0]->denied;
		$data['total'] = $return_data[0]->total;

		$data['approved_percent'] = ($return_data[0]->approved / $return_data[0]->total) * 100;
		$data['pending_percent'] = ($return_data[0]->pending / $return_data[0]->total) * 100;
		$data['denied_percent'] = ($return_data[0]->denied / $return_data[0]->total) * 100;

		 $sql = "SELECT COUNT(id) AS id FROM region
                UNION
                SELECT COUNT(id) AS id FROM zone
                UNION
                SELECT COUNT(id) AS id FROM woreda";
		$result = $this->db->query($sql);
		$return_data = $result->result();

		$data['region'] = $return_data[0]->id;
		$data['zone'] = $return_data[1]->id;
		$data['woreda'] = $return_data[2]->id;


	    $this->load->view('templates/header', $data);
		$this->load->view('dashboard/index');
	    $this->load->view('templates/footer');
	}

}