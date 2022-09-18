<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	/**
	*/
	public function index(){
		$this->load->helper('common_helper');
		$this->load->view('login/index');
		//$this->load->view('templates/footer');
	}
	public function authentication() 
	{
		try 
		{
			
			$user_name	= $_POST['username'];
			$password	= $_REQUEST['password'];
			//$this->load->model('Encryption');
			//$this->Encryption->initialize();			
			//$encryptedtext = $this->Encryption->encrypt($password);

			$commandText = "SELECT 	*
								FROM account a 
								WHERE a.username = ? 
								    AND a.password = ?
								    AND a.status = 1";
			$result = $this->db->query($commandText,array($user_name,$password));
			$query_result = $result->result(); 

			if(count($query_result) == 0) 
			{
				$data = array("success"=> false, "data"=>"Username or password not found");
				die(json_encode($data));
			}
			
			$this->load->library('session');
			$id = $query_result[0]->user_id;
			$type = $query_result[0]->type;

			if($type == 'Employee'){
				$commandText = "SELECT id, 
                                       CONCAT(fname, ' ', mname, ' ', lname) AS full_name, 
                                       email,
                                       role_id 
                                       FROM employee 
                                WHERE id = $id";
                $result = $this->db->query($commandText);
			    $query_result = $result->result();
			}               
         else {
             $commandText = "SELECT id, 
                                       CONCAT(fname, ' ', lname) AS full_name, 
                                       email,
                                       7 as role_id 
                                       FROM citizen 
                                WHERE id = $id";
             $result = $this->db->query($commandText);
			    $query_result = $result->result();
            }
			 
			$newdata = array(
				'id'			=> $query_result[0]->id,
				'full_name'			=> $query_result[0]->full_name,
				'email'		=> $query_result[0]->email,
				'username'			=> $user_name,
				'type'			=> $type,
				'role'			=> $query_result[0]->role_id,
			);
			$this->session->set_userdata($newdata);
			$ForWhom = $type;
			if($type == 'Employee'){
               $route = "dashboard";
			}
			else{
				$route = "dashboard2";
			}
				
				

			$arr = array();  
			$arr['success'] = true;
			$arr['data'] = $route;
			$arr['ForWhom'] =$ForWhom;
			die(json_encode($arr));
		}
		catch(Exception $e) 
		{
			$data = array("success"=> false, "data"=>$e->getMessage());
			die(json_encode($data));
		}
	}
}