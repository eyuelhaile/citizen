<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Woreda extends CI_Controller {
	/**
	*/
	public function index(){
	    $this->load->helper('common_helper');
	    $this->load->library('session');
	    $data['session'] = $this->session->all_userdata();
	    $this->load->model('Link');
	    $data['menu'] = $this->Link->fetch_menu();
	    $this->load->view('templates/header', $data);
		$this->load->view('woreda/index');
	    $this->load->view('templates/footer');
	}
	public function woreda_list()
	{
		try 
		{
			$sql = "SELECT a.*, b.description as zone, b.id as zone_id, c.id as region_id, c.description as region FROM woreda a
			 left join zone b on b.id = a.zone_id
			 left join region c on c.id = b.region_id";
			$result = $this->db->query($sql);
			$return_data = $result->result(); 

			$data = array();

			foreach($return_data as $key => $value) 
			{	
				$data['data'][] = array(
					'id'             => $value->id,
					'description'    => $value->description,
					'woreda_code'    => $value->code,
					'region'         => $value->region,
					'region_id'      => $value->region_id,
					'zone'           => $value->zone,
					'zone_id'        => $value->zone_id
				);
			}
            
			$data['success'] = true;
			die(json_encode($data));
		} 
		catch (Exception $e) 
		{

		}
	}
	public function save_woreda() 
	{
		try 
		{ 

			$woreda_name			= $_POST['woreda_name'];
			$woreda_code			= $_POST['woreda_code'];
			$zone			        = $_POST['zone'];


			$sql = "SELECT * FROM woreda WHERE description = '$woreda_name' or code = '$woreda_code'";
		    $excute = $this->db->query($sql);
		    $return_data = $excute->result(); 
		    if(count($return_data) > 0) 
			{
				$data = array("success"=> false, "data"=>"Woreda already exist. check code or name");
				die(json_encode($data));
			}

		
			$this->load->model('woreda_model');
				
			$this->woreda_model->description = $woreda_name;
			$this->woreda_model->code 	     = $woreda_code;
			$this->woreda_model->zone_id 	 = $zone;
			$this->woreda_model->insert();

			$data = array();  
			$data['data'] = "Woreda Saved Sucessfully";
			die(json_encode($data));
		}
		catch(Exception $e) 
		{
			$data = array("success"=> false, "data"=>$e->getMessage());
			die(json_encode($data));
		}
	}
	public function update_woreda() 
	{
		try 
		{ 

			$id				        = $_POST['id'];
			$woreda_name			= $_POST['woreda_name'];
			$woreda_code			= $_POST['woreda_code'];
			$zone			        = $_POST['zone'];

			$sql = "SELECT * FROM woreda WHERE (description = '$woreda_name' or code = '$woreda_code') and id <> '$id'";
		    $excute = $this->db->query($sql);
		    $return_data = $excute->result(); 
		    if(count($return_data) > 0) 
			{
				$data = array("success"=> false, "data"=>"Woreda already exist. check code or name");
				die(json_encode($data));
			}
            $sql = "UPDATE woreda SET code = '$woreda_code',
                                      description = '$woreda_name',
                                      zone_id = '$zone'
                                      WHERE id = $id";
		    $excute = $this->db->query($sql);		

			$data = array();  
			$data['data'] = "Woreda Updated Sucessfully";
			die(json_encode($data));
		}
		catch(Exception $e) 
		{
			$data = array("success"=> false, "data"=>$e->getMessage());
			die(json_encode($data));
		}
	}	
	public function woreda_delete()
	{
		try 
		{
			$id = $_POST['id'];

			$sql = "SELECT * FROM citizen WHERE woreda_id = '$id'";
		    $excute = $this->db->query($sql);
		    $return_data = $excute->result(); 
		    if(count($return_data) > 0) 
			{
				$data = array("success"=> false, "data"=>"Woreda used by one or more citizen. Cannot be deleted");
				die(json_encode($data));
			}
			$sql = "SELECT * FROM employee WHERE woreda_id = '$id'";
		    $excute = $this->db->query($sql);
		    $return_data = $excute->result(); 
		    if(count($return_data) > 0) 
			{
				$data = array("success"=> false, "data"=>"Woreda used by one or more Employees. Cannot be deleted");
				die(json_encode($data));
			}

			$sql = "DELETE FROM woreda where id = $id";
			$result = $this->db->query($sql); 

			$data = array();  
			$data['data'] = "Woreda Deleted Sucessfully";
			$data['success'] = true;
			die(json_encode($data));
		} 
		catch (Exception $e) 
		{

		}
	}


}