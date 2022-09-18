<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_view extends CI_Controller {
	/**
	*/
	public function index(){
	    $this->load->helper('common_helper');
	    $this->load->library('session');
	    $data['session'] = $this->session->all_userdata();
	    $this->load->model('Link');
	    $data['menu'] = $this->Link->fetch_menu();
	    $this->load->view('templates/header', $data);
		$this->load->view('employee_view/index');
	    $this->load->view('templates/footer');
	}
	public function employee_list()
	{
		try 
		{
			$sql = "SELECT a.*,
			               concat(a.fname, ' ', a.lname) as full_name,
			               b.description as region,
			               c.description as zone,
			               d.description as woreda,
			               e.role_name,
			               IF(sex=0, 'Male', 'Female') as sex
						FROM employee a
						left join region b on b.id = a.region_id
						left join zone c on c.id = a.zone_id
						left join woreda d on d.id = a.woreda_id
						left join role e on e.role_id = a.role_id 
						where a.active = 1";
			$result = $this->db->query($sql);
			$return_data = $result->result(); 

			$data = array();

			foreach($return_data as $key => $value) 
			{	
				$data['data'][] = array(
					'id'         => $value->id,
					'full_name'  => $value->full_name,
					'username'   => $value->username,
					'age'        => $value->age,
					'sex'        => $value->sex,
					'phone_no'   => $value->phone_no,
					'email'      => $value->email,
					'region'     => $value->region,
					'zone'       => $value->zone,
					'woreda'     => $value->woreda,
					'kebele'     => $value->kebele,
					'role_name'  => $value->role_name,
					'profile_pic' => base_url() . $value->profile_pic
				);
			}
            
			$data['success'] = true;
			die(json_encode($data));
		} 
		catch (Exception $e) 
		{

		}
	}
	public function employee_delete()
	{
		try 
		{
			$id = $_POST['id'];
			$sql = "UPDATE  employee SET active = 0 where id = $id";
			$result = $this->db->query($sql); 

			$data = array();  
			$data['data'] = "Employee Deleted Sucessfully";
			$data['success'] = true;
			die(json_encode($data));
		} 
		catch (Exception $e) 
		{

		}
	}

}