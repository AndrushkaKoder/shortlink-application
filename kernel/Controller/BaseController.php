<?php

namespace Kernel\Controller;

use Kernel\Auth\Auth;
use Kernel\Http\Redirect;
use Kernel\Http\Request;
use Kernel\Session\Session;
use Kernel\View\View;

class BaseController
{
	public Session $session;
	public Request $request;
	public View $view;
	public Redirect $redirect;
	public Auth $auth;

	public function setSession(Session $session): void
	{
		$this->session = $session;
	}

	public function setRequest(Request $request): void
	{
		$this->request = $request;
	}

	public function setView(View $view): void
	{
		$this->view = $view;
	}

	public function setRedirect(Redirect $redirect): void
	{
		$this->redirect = $redirect;
	}

	public function setAuth(Auth $auth): void
	{
		$this->auth = $auth;
	}
}