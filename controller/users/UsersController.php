<?php
include_once('controller/Controller.php');

include_once('model/User.php');

class UsersController extends Controller
{
	public $model;

	public function __construct()
	{
        $this->User = new User();
    }

	public function invoke()
	{
		if ($this->isLogin()) {
			$this->redirect('users/login');
		} else {
			$this->redirect('users/myaccount');
		}
	}

	public function login()
	{
		if ($this->isLogin()) {
			$this->redirect('users/myaccount');
		}

		if (!empty($_POST)) {
			$user = $this->User->loginCheck($_POST);
			if (empty($user)) {
				$this->error('Invalid email or password');
			} else if (!password_verify($_POST['password'], $user->password)) {
				$this->error('Invalid email or password');
			} else {
				$this->setLoginSession($user);

				$this->redirect('users/myaccount');
			}
		}

		$this->render('users/login');
	}

	public function myaccount()
	{
		$userId = $this->checkIsUserLogin();

		$user = $this->User->findById($userId);

		$this->render(
			'users/myaccount',
			[
				'user' => $user
			]
		);
	}

	public function logout()
	{
		$this->deleteUserSession();

		$this->success('Logout successfully.');

		$this->redirect('users/login');
	}




}
?>