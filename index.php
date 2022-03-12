<?php
	include_once('controller/users/UsersController.php');

	if (!empty($_GET['url'])) {
		$params = explode('/', $_GET['url']);

		$className = ucfirst($params[0]).'Controller';

		$controller = new $className();

		$action = $params[1];

		$controller->$action();
	} else {
		$controller = new UsersController();

		$controller->invoke();
	}
?>
