<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_reg extends CI_Controller {
	/**
	*/
	public function index(){
	    $this->load->helper('common_helper');
	    $this->load->library('session');
	    $data['session'] = $this->session->all_userdata();
	    $this->load->model('Link');
	    $data['menu'] = $this->Link->fetch_menu();
	    $emp_id = 0;
	    if(isset($_GET['emp_id'])){
           $emp_id = $_GET['emp_id'];
           $sql = "SELECT 
								*
							FROM employee where id = $emp_id";
		   $result = $this->db->query($sql);
		   $return_data = $result->result();     
		   $row = array(); 
		   foreach($return_data as $key => $value) 
		   {	
		   	 $row['id'] = $value->id;
		   	 $row['fname'] = $value->fname;
		   	 $row['lname'] = $value->lname;
		   	 $row['email'] = $value->email;
		   	 $row['age'] = $value->age;
		   	 $row['phoneNumber'] = $value->phone_no;
		   	 $row['sex'] = $value->sex;
		   	 $row['kebele'] = $value->kebele;
		   	 $row['username'] = $value->username;
		   	 $row['role'] = $value->role_id;
		   	 $row['region_id'] = $value->region_id;
		   	 $row['zone_id'] = $value->zone_id;
		   	 $row['woreda_id'] = $value->woreda_id;
		   	 $row['profile_pic'] = base_url() . $value->profile_pic;
		   }
		   $data['employee'] = $row;
	    }
	    else {
	    	 $row['id'] = 0;
		   	 $row['fname'] = "";
		   	 $row['lname'] = "";
		   	 $row['email'] = "";
		   	 $row['age'] = 0;
		   	 $row['phoneNumber'] = "";
		   	 $row['sex'] = "";
		   	 $row['kebele'] = "";
		   	 $row['username'] = "";
		   	 $row['role'] = "";
		   	 $row['region_id'] = "";
		   	 $row['zone_id'] = "";
		   	 $row['woreda_id'] = "";
		   	 $row['profile_pic'] = "../assets/img/avatars/user.png";
		   
		   $data['employee'] = $row;
	    }

	    $this->load->view('templates/header', $data);
		$this->load->view('employee_reg/index');
	    $this->load->view('templates/footer');
	}
	public function region_list()
	{
		try 
		{
			$sql = "SELECT 
								*
							FROM region";
			$result = $this->db->query($sql);
			$return_data = $result->result(); 

			$data = array();

			foreach($return_data as $key => $value) 
			{	
				$data['data'][] = array(
					'id'           => $value->id,
					'description'  => $value->description
				);
			}
            
			$data['success'] = true;
			die(json_encode($data));
		} 
		catch (Exception $e) 
		{

		}
	}
	public function zone_list()
	{
		try 
		{
		    $region_id = $_POST['region_id'];
			$sql = "SELECT 
								*
							FROM zone 
							WHERE region_id= $region_id";
			$result = $this->db->query($sql);
			$return_data = $result->result(); 

			$data = array();
			$record = array();

			foreach($return_data as $key => $value) 
			{	
				$data['data'][] = array(
					'id'           => $value->id,
					'description'  => $value->description
				);
			}
			$data['success'] = true;
			die(json_encode($data));
		} 
		catch (Exception $e) 
		{
			die();	
		}
	}
	public function woreda_list()
	{
		try 
		{
		    $zone_id = $_POST['zone_id'];
			$sql = "SELECT 
								*
							FROM woreda
							WHERE zone_id = $zone_id";
			$result = $this->db->query($sql);
			$return_data = $result->result(); 

			$data = array();

			foreach($return_data as $key => $value) 
			{	
				$data['data'][] = array(
					'id'           => $value->id,
					'description'  => $value->description
				);
			}

			$data['success'] = true;
			die(json_encode($data));
		} 
		catch (Exception $e) 
		{
			die();	
		}
	}
	public function role_list()
	{
		try 
		{
			$sql = "SELECT 
								*
							FROM role";
			$result = $this->db->query($sql);
			$return_data = $result->result(); 

			$data = array();

			foreach($return_data as $key => $value) 
			{	
				$data['data'][] = array(
					'id'           => $value->role_id,
					'description'  => $value->role_name
				);
			}

			$data['success'] = true;
			die(json_encode($data));
		} 
		catch (Exception $e) 
		{
			die();	
		}
	}
	public function save_employee() 
	{
		try 
		{ 

			//$id				    = $_POST['id'];
			$firstName			= $_POST['firstName'];
			$lastName			= $_POST['lastName'];
			$email				= $_POST['email'];
			$phoneNumber		= $_POST['phoneNumber'];
			$age				= $_POST['age'];
			$sex			= $_POST['sex'];
			$region			= $_POST['region'];
			$zone			= $_POST['zone'];
			$woreda		    = $_POST['woreda'];
			$role			= $_POST['role'];
			$username		= $_POST['username'];
			$kebele			= $_POST['kebele'];

			$name 	= $_FILES['upload']['name'];  
			$source = $_FILES['upload']['tmp_name'];
			$path = "image/";
	        $valid_formats = array("jpg", "jpeg","gif","png");

	        $arr = array();  
			list($txt, $ext) = explode(".", $name);
			$countExt = count(explode(".", $name));
			if($countExt > 2)
			{
				$arr['success'] = false;
				$arr['data'] = "Invalid type, Allowed image types are jpg, gif and png";
				die(json_encode($arr));				
			}
	        
			
			
			
			$sql = "SELECT * FROM employee WHERE username = '$username'";
		    $excute = $this->db->query($sql);
		    $return_data = $excute->result(); 
		    if(count($return_data) > 0) 
			{
				$data = array("success"=> false, "data"=>"Username already exist.");
				die(json_encode($data));
			}

			if(in_array($ext,$valid_formats))
			{
				if(file_exists ($path.$name))
					unlink($path.$name);

				move_uploaded_file($source,$path.$name);
			}
			$this->load->model('employee');
				
			$this->employee->fname 	= $firstName;
			$this->employee->lname 	= $lastName;
			$this->employee->email 	= $email;
			$this->employee->phone_no 	= $phoneNumber;
			$this->employee->age 	= $age;
			$this->employee->sex 	= $sex;
			$this->employee->region_id 	= $region;
			$this->employee->zone_id 	= $zone;
			$this->employee->woreda_id 	= $woreda;
			$this->employee->role_id 	= $role;
			$this->employee->username 	= $username;
			$this->employee->kebele 	= $kebele;
			$this->employee->created_date 	= date('Y-m-d');
			$this->employee->profile_pic 	= $path.$name;
			$this->employee->active 	= 1;
			$this->employee->insert();

			$this->load->model('account');

			$password = substr(str_shuffle("0123456789"), 0, 6);
				
			$this->account->email 	    = $email;
			$this->account->username 	= $username;
			$this->account->password 	= $password;
			$this->account->type 	    = 'Employee';
			$this->account->user_id 	= $this->employee->id;
			$this->account->status 	= 1;
			$this->account->insert();	

			

			$data = array();  
			$data['data'] = "Employee Saved Sucessfully";
			die(json_encode($data));
		}
		catch(Exception $e) 
		{
			$data = array("success"=> false, "data"=>$e->getMessage());
			die(json_encode($data));
		}
	}	
	public function update_employee() 
	{
		try 
		{ 

			$id				    = $_POST['id'];
			$firstName			= $_POST['firstName'];
			$lastName			= $_POST['lastName'];
			$email				= $_POST['email'];
			$phoneNumber		= $_POST['phoneNumber'];
			$age				= $_POST['age'];
			$sex			= $_POST['sex'];
			$region			= $_POST['region'];
			$zone			= $_POST['zone'];
			$woreda		    = $_POST['woreda'];
			$role			= $_POST['role'];
			$username		= $_POST['username'];
			$kebele			= $_POST['kebele'];
            
            
			if(isset($_FILES['upload']['name'])){
				$sql = "UPDATE employee SET fname = '$firstName',
			                   lname = '$lastName',
			                   email = '$email',
			                   phone_no = '$phoneNumber',
			                   age   = '$age',
			                   sex    = '$sex',
			                   region_id    = '$region',
			                   zone_id    = '$zone',
			                   woreda_id    = '$woreda',
			                   role_id    = '$role',
			                   username    = '$username',
			                   kebele    = '$kebele'
			                Where id = $id";
		       $excute = $this->db->query($sql);
			}
			else {
				$sql = "UPDATE employee SET fname = '$firstName',
			                   lname = '$lastName',
			                   email = '$email',
			                   phone_no = '$phoneNumber',
			                   age   = '$age',
			                   sex    = '$sex',
			                   region_id    = '$region',
			                   zone_id    = '$zone',
			                   woreda_id    = '$woreda',
			                   role_id    = '$role',
			                   username    = '$username',
			                   kebele    = '$kebele'
			                Where id = $id";
		        $excute = $this->db->query($sql);

			}
			
		    
			$data = array();  
			$data['data'] = "Employee Updated Sucessfully";
			die(json_encode($data));
		}
		catch(Exception $e) 
		{
			$data = array("success"=> false, "data"=>$e->getMessage());
			die(json_encode($data));
		}
	}	

}