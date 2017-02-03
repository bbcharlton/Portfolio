<?php

class Users {
	public function __construct($parent) {
		$this->db = $parent->db;
	}

	public function select($sql, $value=array()) {
		$this->sql = $this->db->prepare($sql);
		$result = $this->sql->execute($value);
		$data = $this->sql->fetchAll();
		return $data;
	}

	public function add($sql, $value=array()) {
		$this->sql = $this->db->prepare($sql);
		$result = $this->sql->execute($value);
	}

	public function update($sql, $value=array()) {
		$this->sql = $this->db->prepare($sql);
		$result = $this->sql->execute($value);
	}

	public function delete($sql, $value=array()) {
		$this->sql = $this->db->prepare($sql);
		$result = $this->sql->execute($value);
	}
}


?>