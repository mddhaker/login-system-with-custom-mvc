<?php

class Main
{
	public $server = "localhost";
	public $user = "root";
	public $pass = "";
	public $dbase = "mvc";

	public function __construct()
	{
		$this->connection = new mysqli($this->server, $this->user, $this->pass, $this->dbase);

		if (!$this->connection) {
			$this->error("Connection attempt failed");
			exit();
		}
    }

	public function findFirst(string $query): object
	{
		$result = $this->connection->query($query);

		if ($result->num_rows == 0) {
			return (object)$oVal = "";
		}

		$this->connectClose();

		return $result->fetch_object();
	}

	public function findAll(string $query): array
	{
		$results = $this->connection->query($query);

		if ($results->num_rows == 0) {
			return [];
		}

		$data = [];
		while($row = $results->fetch_assoc())
		{
			$data[] = $row;
		}

		$this->connectClose();

		return $data;
	}

	private function connectClose(): void {
		$this->connection->close();
	}
}
?>