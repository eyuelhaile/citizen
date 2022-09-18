<?php


class citizen extends My_Model {

	const DB_TABLE = 'citizen';
	const DB_TABLE_PK = 'id';

	public $id;
	public $username;
	public $password;
	public $fname;
	public $mname;
	public $lname;
	public $sex;
	public $age;
	public $nationality;
	public $region_id;
	public $zone_id;
	public $woreda_id;
	public $kebele;
	public $phone_no;
	public $email;
	public $motherfullName;
	public $dob;
	public $marital_status;
	public $education_status;
	public $profession;
	public $workplace;
	public $blood_type;
	public $emergency_contact;
	public $profile_pic;
	public $status;
	public function insert(){
		unset($this->{$this::DB_TABLE_PK});
		$this->db->insert($this::DB_TABLE,$this);
		$this->{$this::DB_TABLE_PK} = $this->db->insert_id();
	}

	public function update($id){
		$this->db->update($this::DB_TABLE, $this, array($this::DB_TABLE_PK => $id));
	}
}