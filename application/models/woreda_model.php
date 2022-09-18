<?php


class woreda_model extends My_Model {

	const DB_TABLE = 'woreda';
	const DB_TABLE_PK = 'id';

	public $id;
	public $zone_id;
	public $code;
	public $description;
	public function insert(){
		unset($this->{$this::DB_TABLE_PK});
		$this->db->insert($this::DB_TABLE,$this);
		$this->{$this::DB_TABLE_PK} = $this->db->insert_id();
	}

	public function update($id){
		$this->db->update($this::DB_TABLE, $this, array($this::DB_TABLE_PK => $id));
	}
}