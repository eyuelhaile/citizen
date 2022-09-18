<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_list extends CI_Controller {
	/**
	*/
	public function index(){
	    $this->load->helper('common_helper');
	    $this->load->library('session');
	    $data['session'] = $this->session->all_userdata();
	    $this->load->model('Link');
	    $data['menu'] = $this->Link->fetch_menu();
	    $this->load->view('templates/header', $data);
		$this->load->view('account_list/index');
	    $this->load->view('templates/footer');
	}
	public function accounts()
	{
		try 
		{
			$sql = "SELECT * FROM 
              (SELECT a.id, CONCAT(b.fname, b.lname) AS full_name, a.`email`, a.`username`, a.`password`, a.type FROM account a
              LEFT JOIN `employee` b ON b.id = a.`user_id`
              WHERE TYPE='Employee'
              UNION
              SELECT a.id, CONCAT(b.fname, b.mname) AS full_name, a.`email`, a.`username`, a.`password`, a.type FROM account a
              LEFT JOIN `citizen` b ON b.id = a.`user_id`
              WHERE TYPE='Citizen') AS table1";
			$result = $this->db->query($sql);
			$return_data = $result->result(); 

			$data = array();

			foreach($return_data as $key => $value) 
			{	
				$data['data'][] = array(
					'id'         => $value->id,
					'full_name'  => $value->full_name,
					'email'      => $value->email,
					'username'   => $value->username,
					'password'   => $value->password,
					'type'       => $value->type
				);
			}
            
			$data['success'] = true;
			die(json_encode($data));
		} 
		catch (Exception $e) 
		{

		}
	}
	public function save_region() 
	{
		try 
		{ 

			$region_name			= $_POST['region_name'];
			$region_code			= $_POST['region_code'];

			$sql = "SELECT * FROM region WHERE description = '$region_name' or code = '$region_code'";
		    $excute = $this->db->query($sql);
		    $return_data = $excute->result(); 
		    if(count($return_data) > 0) 
			{
				$data = array("success"=> false, "data"=>"Region already exist. check code or name");
				die(json_encode($data));
			}

		
			$this->load->model('region_model');
				
			$this->region_model->description = $region_name;
			$this->region_model->code 	     = $region_code;
			$this->region_model->insert();

			$data = array();  
			$data['data'] = "Region Saved Sucessfully";
			die(json_encode($data));
		}
		catch(Exception $e) 
		{
			$data = array("success"=> false, "data"=>$e->getMessage());
			die(json_encode($data));
		}
	}
	public function update_region() 
	{
		try 
		{ 

			$id				        = $_POST['id'];
			$region_name			= $_POST['region_name'];
			$region_code			= $_POST['region_code'];

			$sql = "SELECT * FROM region WHERE (description = '$region_name' or code = '$region_code') and id <> '$id'";
		    $excute = $this->db->query($sql);
		    $return_data = $excute->result(); 
		    if(count($return_data) > 0) 
			{
				$data = array("success"=> false, "data"=>"Region already exist. check code or name");
				die(json_encode($data));
			}
            $sql = "UPDATE region SET code = '$region_code',
                                      description = '$region_name'
                                      WHERE id = $id";
		    $excute = $this->db->query($sql);		

			$data = array();  
			$data['data'] = "Region Updated Sucessfully";
			die(json_encode($data));
		}
		catch(Exception $e) 
		{
			$data = array("success"=> false, "data"=>$e->getMessage());
			die(json_encode($data));
		}
	}	
	public function region_delete()
	{
		try 
		{
			$id = $_POST['id'];

			$sql = "SELECT * FROM citizen WHERE region_id = '$id'";
		    $excute = $this->db->query($sql);
		    $return_data = $excute->result(); 
		    if(count($return_data) > 0) 
			{
				$data = array("success"=> false, "data"=>"Region used by one or more citizen. Cannot be deleted");
				die(json_encode($data));
			}
			$sql = "SELECT * FROM employee WHERE region_id = '$id'";
		    $excute = $this->db->query($sql);
		    $return_data = $excute->result(); 
		    if(count($return_data) > 0) 
			{
				$data = array("success"=> false, "data"=>"Region used by one or more Employees. Cannot be deleted");
				die(json_encode($data));
			}

			$sql = "DELETE FROM region where id = $id";
			$result = $this->db->query($sql); 

			$data = array();  
			$data['data'] = "Region Deleted Sucessfully";
			$data['success'] = true;
			die(json_encode($data));
		} 
		catch (Exception $e) 
		{

		}
	}

}