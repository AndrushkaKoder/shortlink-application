<?php

namespace App\Controllers\Auth;

use Kernel\Controller\BaseController;

class LoginController extends BaseController
{

	use ValidateTrait;

	public function index(): void
	{
		$this->view->page('auth.login');
	}

	public function login(): void
	{
		$data = $this->request->post();

		if (!$this->validateData($data)) {
			$this->redirect
				->with('error', 'Данные не верны!')
				->to('/login');
		}

		if ($this->auth->attempt($data['email'], $data['password'])) {
			$this->redirect->with('success', 'Здравствуйте!')->to('/');
		} else {
			$this->redirect->with('error', 'Неверный логин/пароль =(')->to('/login');
		}
	}
}