<?php

namespace App\Controllers\Auth;

use App\Models\User;
use Kernel\Controller\BaseController;

class RegisterController extends BaseController
{
	use ValidateTrait;

	public function index(): void
	{
		$this->view->page('auth.register');
	}

	public function register(): void
	{
		$data = $this->request->post();
		if (!$this->validateData($data, true)) {
			$this->session->set('error', 'Данные не верны!');
			$this->redirect->to('/register');
		}

		if (!$this->checkUnique($data['email'])) {
			$this->session->set('error', 'Такой пользователь уже существует!');
			$this->redirect->to('/register');
		}


		$id = User::query()->insert([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => hashPassword($data['password'])
		]);

		if ($id) {
			$this->session->set('user', $id);
			$this->redirect->to('/');
		}
	}

	private function checkUnique(string $email): bool
	{
		return !User::query()->first(['email' => $email]);
	}

}