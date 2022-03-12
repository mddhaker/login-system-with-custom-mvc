<?php
session_start();

class Controller
{
	public $base_url = 'http://localhost/test';

	public function __construct()
	{
        //$this->model = new Model();
    }

	public function isLogin(): bool
	{
		return !empty($_SESSION['user_id']);
	}

	public function error(string $message): void
	{
		$_SESSION['error'] = $message;
	}

	public function success(string $message): void
	{
		$_SESSION['success'] = $message;
	}

	public function checkIsUserLogin()
	{
		if ($this->isLogin()) {
			return $_SESSION['user_id'];
		} else {
			$this->redirect('users/login');
		}
	}

	public function deleteUserSession(): void
	{
		session_destroy();
	}

	public function setLoginSession(object $user): void
	{
		$_SESSION['user_id'] = $user->id;
		$_SESSION['user_name'] = $user->name;
		$_SESSION['user_email'] = $user->email;
	}

	public function redirect(string $controllerAction, array $args = [])
	{
		$location = $this->base_url . "/" . $controllerAction;

		if (!empty($args)) {
			$location =  "/" . implode("/",$args);
		}

		header("Location: " . $location);
		exit;
	}

	public function render(string $viewFileName, array $args = [])
	{
		if (!empty($args)) {
			foreach ($args as $key => $value) {
				${"$key"} = $value;
			}
		}

		include 'view/' . $viewFileName . '.php';
	}

	public function prr($data)
	{
		echo '<pre>';
		print_r($data);exit;
	}


}
?>