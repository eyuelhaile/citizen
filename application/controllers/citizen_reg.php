<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Citizen_reg extends CI_Controller {
	/**
	*/
	public function index(){
	    $this->load->helper('common_helper');
	    $this->load->library('session');
	    $data['session'] = $this->session->all_userdata();
	    $this->load->model('Link');
	    $data['menu'] = $this->Link->fetch_menu();
	    $emp_id = 0;
	    if(isset($_GET['cit_id'])){
           $emp_id = $_GET['cit_id'];
           $sql = "SELECT 
								*
							FROM citizen where id = $cit_id";
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
		   	 $row['region_id'] = $value->region_id;
		   	 $row['zone_id'] = $value->zone_id;
		   	 $row['woreda_id'] = $value->woreda_id;
		   	 $row['profile_pic'] = base_url() . $value->profile_pic;
		   }
		   $data['citizen'] = $row;
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
		   
		   $data['citizen'] = $row;
	    }

	    $this->load->view('templates/header', $data);
		$this->load->view('citizen_reg/index');
	    $this->load->view('templates/footer');
	}
	public function nationality_list()
	{
		try 
		{
			$sql = "SELECT 
								*
							FROM nationality";
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
	public function save_citizen() 
	{
		try 
		{ 

			//$id				    = $_POST['id'];
			$firstName			= $_POST['firstName'];
			$lastName			= $_POST['lastName'];
			$middleName			    = $_POST['middleName'];
			$motherName			= $_POST['motherName'];
			$email				= $_POST['email'];
			$phoneNumber		= $_POST['phoneNumber'];
			$age				= $_POST['age'];
			$sex			= $_POST['sex'];
			$nationality			= $_POST['nationality'];
			$region			= $_POST['region'];
			$zone			= $_POST['zone'];
			$woreda		    = $_POST['woreda'];
			$username		= $_POST['username'];
			$password		= $_POST['password'];
			$kebele			= $_POST['kebele'];

			$maritalStatus		= $_POST['maritalStatus'];
			$educationalStatus	= $_POST['educationalStatus'];
			$profession			= $_POST['profession'];
			$workplace			= $_POST['workplace'];
			$blood_type			= $_POST['bloodType'];

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
	        
			
			
			
			$sql = "SELECT * FROM citizen WHERE username = '$username'";
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
			$this->load->model('citizen');
				
			$this->citizen->fname 	= $firstName;
			$this->citizen->mname 	= $middleName;
			$this->citizen->lname 	= $lastName;
			$this->citizen->motherfullName 	= $motherName;
			$this->citizen->email 	= $email;
			$this->citizen->phone_no 	= $phoneNumber;
			$this->citizen->age 	= $age;
			$this->citizen->sex 	= $sex;
			$this->citizen->nationality 	= $nationality;
			$this->citizen->region_id 	= $region;
			$this->citizen->zone_id 	= $zone;
			$this->citizen->woreda_id 	= $woreda;
			$this->citizen->username 	= $username;
			$this->citizen->password 	= $password;
			$this->citizen->kebele 	= $kebele;
			$this->citizen->marital_status 	= $maritalStatus;
			$this->citizen->education_status 	= $educationalStatus;
			$this->citizen->profession 	= $profession;
			$this->citizen->workplace 	= $workplace;
			$this->citizen->blood_type 	= $blood_type;
			$this->citizen->created_date 	= date('Y-m-d');
			$this->citizen->profile_pic 	= $path.$name;
			$this->citizen->status 	= 'Pending';
			$this->citizen->insert();

			$this->load->model('account');

			//$password = substr(str_shuffle("0123456789"), 0, 6);
				
			$this->account->email 	    = $email;
			$this->account->username 	= $username;
			$this->account->password 	= $password;
			$this->account->type 	    = 'Citizen';
			$this->account->user_id 	= $this->citizen->id;
			$this->account->status 	= 1;
			$this->account->insert();	

			

			$data = array();  
			$data['data'] = "Citizen Saved Sucessfully";
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