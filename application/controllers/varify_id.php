<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Varify_id extends CI_Controller {
	/**
	*/
	public function index(){
	    $this->load->helper('common_helper');
	    $this->load->library('session');
	    $data['session'] = $this->session->all_userdata();
	    $this->load->model('Link');
	    $data['menu'] = $this->Link->fetch_menu();
	    $this->load->view('templates/header', $data);
		$this->load->view('varify_id/index');
	    $this->load->view('templates/footer');
	}
	public function varify()
	{
		try 
		{
			$id = $_POST['id'];
			$decrypted = base64_decode($id);
			$sql = "SELECT a.id, 
                      CONCAT(fname,' ', mname, ' ', lname) AS full_name,
                      IF(sex = 0, 'Female','Male') AS sex,
                      a.blood_type,
                      a.phone_no,
                      a.email,
                      a.citizen_id,
                      a.profile_pic,
                      a.created_date,
                      e.description as nationality,
                      CONCAT(b.description, ' ', c.description, ' ', d.description, ' ', a.kebele) AS address 
                   FROM `citizen` a
                   LEFT JOIN `region` b ON b.id = a.`region_id`
                   LEFT JOIN zone c ON c.id = a.`zone_id`
                   LEFT JOIN woreda d ON d.`id` = a.`woreda_id`
                   LEFT JOIN nationality e ON e.id = a.`nationality`
                   WHERE a.citizen_id = '$decrypted' and status='Approved'";
			$result = $this->db->query($sql);
			$return_data = $result->result(); 
			if(count($return_data) == 0){
				$arr['success'] = false;
				$arr['data'] = "Not Varified";
				$arr['btn_class'] = "btn btn-outline-danger btn-lg";
				die(json_encode($arr));
			}
 

			$data = array();
			$single = array();

			foreach($return_data as $key => $value) 
			{	
				$btn_class = "";
				if(date('Y-m-d', strtotime($value->created_date. ' + 5 years')) <  date('Y-m-d'))
					$btn_class = "btn btn-outline-warning btn-lg";
				else 
					$btn_class = "btn btn-outline-success btn-lg";
				$single['id']  = $value->id;
				$single['full_name']  = $value->full_name;
				$single['address']  = $value->address;
				$single['btn_class']  = $btn_class;
				$single['id_number']  = $value->citizen_id;
				$single['profile_pic']  = base_url() .$value->profile_pic;
				$single['exp_date']  = date('Y-m-d', strtotime($value->created_date. ' + 5 years'));
				$single['class']  = date('Y-m-d', strtotime($value->created_date. ' + 5 years'));
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