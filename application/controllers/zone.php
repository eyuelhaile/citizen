<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Zone extends CI_Controller {
	/**
	*/
	public function index(){
	    $this->load->helper('common_helper');
	    $this->load->library('session');
	    $data['session'] = $this->session->all_userdata();
	    $this->load->model('Link');
	    $data['menu'] = $this->Link->fetch_menu();
	    $this->load->view('templates/header', $data);
		$this->load->view('zone/index');
	    $this->load->view('templates/footer');
	}
	public function zone_list()
	{
		try 
		{
			$sql = "SELECT a.*, b.description as region, b.id as region_id FROM zone a left join region b on b.id = a.region_id";
			$result = $this->db->query($sql);
			$return_data = $result->result(); 

			$data = array();

			foreach($return_data as $key => $value) 
			{	
				$data['data'][] = array(
					'id'           => $value->id,
					'description'  => $value->description,
					'zone_code'    => $value->code,
					'region'       => $value->region,
					'region_id'       => $value->region_id
				);
			}
            
			$data['success'] = true;
			die(json_encode($data));
		} 
		catch (Exception $e) 
		{

		}
	}
	public function save_zone() 
	{
		try 
		{ 

			$zone_name			= $_POST['zone_name'];
			$zone_code			= $_POST['zone_code'];
			$region			= $_POST['region'];

			$sql = "SELECT * FROM zone WHERE description = '$zone_name' or code = '$zone_code'";
		    $excute = $this->db->query($sql);
		    $return_data = $excute->result(); 
		    if(count($return_data) > 0) 
			{
				$data = array("success"=> false, "data"=>"Zone already exist. check code or name");
				die(json_encode($data));
			}

		
			$this->load->model('zone_model');
				
			$this->zone_model->description = $zone_name;
			$this->zone_model->code 	     = $zone_code;
			$this->zone_model->region_id 	     = $region;
			$this->zone_model->insert();

			$data = array();  
			$data['data'] = "Zone Saved Sucessfully";
			die(json_encode($data));
		}
		catch(Exception $e) 
		{
			$data = array("success"=> false, "data"=>$e->getMessage());
			die(json_encode($data));
		}
	}
	public function update_zone() 
	{
		try 
		{ 

			$id				        = $_POST['id'];
			$zone_name			= $_POST['zone_name'];
			$zone_code			= $_POST['zone_code'];
			$region			= $_POST['region'];

			$sql = "SELECT * FROM region WHERE (description = '$zone_name' or code = '$zone_code') and id <> '$id'";
		    $excute = $this->db->query($sql);
		    $return_data = $excute->result(); 
		    if(count($return_data) > 0) 
			{
				$data = array("success"=> false, "data"=>"Zone already exist. check code or name");
				die(json_encode($data));
			}
            $sql = "UPDATE zone SET code = '$zone_code',
                                      description = '$zone_name',
                                      region_id = '$region'
                                      WHERE id = $id";
		    $excute = $this->db->query($sql);		

			$data = array();  
			$data['data'] = "Zone Updated Sucessfully";
			die(json_encode($data));
		}
		catch(Exception $e) 
		{
			$data = array("success"=> false, "data"=>$e->getMessage());
			die(json_encode($data));
		}
	}	
	public function zone_delete()
	{
		try 
		{
			$id = $_POST['id'];

			$sql = "SELECT * FROM citizen WHERE zone_id = '$id'";
		    $excute = $this->db->query($sql);
		    $return_data = $excute->result(); 
		    if(count($return_data) > 0) 
			{
				$data = array("success"=> false, "data"=>"Zone used by one or more citizen. Cannot be deleted");
				die(json_encode($data));
			}
			$sql = "SELECT * FROM employee WHERE zone_id = '$id'";
		    $excute = $this->db->query($sql);
		    $return_data = $excute->result(); 
		    if(count($return_data) > 0) 
			{
				$data = array("success"=> false, "data"=>"Zone used by one or more Employees. Cannot be deleted");
				die(json_encode($data));
			}

			$sql = "DELETE FROM zone where id = $id";
			$result = $this->db->query($sql); 

			$data = array();  
			$data['data'] = "Zone Deleted Sucessfully";
			$data['success'] = true;
			die(json_encode($data));
		} 
		catch (Exception $e) 
		{

		}
	}

}