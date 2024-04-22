<?php

namespace Kernel\Auth;

use App\Models\User;
use Kernel\Http\Redirect;
use Kernel\Session\Session;

class Auth
{

	public function __construct(
		private Session  $session,
		private Redirect $redirect,
	)
	{
	}

	public function attempt(string $email, string $password): bool
	{
		$user = User::query()->first(['email' => $email]);

		if (!$user) return false;
		if (!password_verify($password, $user['password'])) return false;

		$this->session->set('user', $user['id']);

		return true;
	}

	public function user(): ?\Kernel\Auth\User
	{
		if (!$this->check()) return null;

		$user = User::query()->first([
			'id' => $this->session->get('user')
		]);

		return !$user ? null : new \Kernel\Auth\User($user['id'], $user['name'], $user['email']);
	}

	public function check($key = 'user'): bool
	{
		return $this->session->has($key);
	}

	public function logout()
	{
		$this->session->delete('user');
		$this->session->destroy();
		$this->redirect->to('/login');
	}
}