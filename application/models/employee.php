<?php


class employee extends My_Model {

	const DB_TABLE = 'employee';
	const DB_TABLE_PK = 'id';

	public $id;
	public $role_id;
	public $username;
	public $password;
	public $fname;
	public $lname;
	public $sex;
	public $age;
	public $region_id;
	public $zone_id;
	public $woreda_id;
	public $kebele;
	public $phone_no;
	public $email;
	public $profile_pic;
	public $active;
	public function insert(){
		unset($this->{$this::DB_TABLE_PK});
		$this->db->insert($this::DB_TABLE,$this);
		$this->{$this::DB_TABLE_PK} = $this->db->insert_id();
	}

	public function update($id){
		$this->db->update($this::DB_TABLE, $this, array($this::DB_TABLE_PK => $id));
	}
}