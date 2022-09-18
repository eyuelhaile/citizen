<?php


class account extends My_Model {

	const DB_TABLE = 'account';
	const DB_TABLE_PK = 'id';

	public $id;
	public $email;
	public $username;
	public $password;
	public $type;
	public $user_id;
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