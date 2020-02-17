<?php
namespace Projet4\Model;

/** 

* Class Manager

* Used to connect to database

**/
class Manager {

	private $db;

	protected function dbConnect() {
		if ($this->db === null) {
			$this->db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
		}
		$this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		return $this->db;
	}
}





