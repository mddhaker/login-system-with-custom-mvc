<?php
include_once('model/Main.php');

class User extends Main {


	public function loginCheck(array $data): object
	{
		$query = "SELECT * FROM users where email='".$data['email']."'";

		return $this->findFirst($query);
	}

	public function findById(int $id): object
	{
		$query = "SELECT * FROM users where id='".$id."'";

		return $this->findFirst($query);
	}
}
?>