<?php

namespace Kernel\Container;

use Kernel\Auth\Auth;
use Kernel\Http\Redirect;
use Kernel\Http\Request;
use Kernel\Router\Router;
use Kernel\Session\Session;
use Kernel\View\View;

class Container
{

	public Request $request;
	public Router $router;
	public View $view;
	public Redirect $redirect;
	public Session $session;
	public Auth $auth;

	public function __construct()
	{
		$this->registerServices();
	}

	private function registerServices(): void
	{

		$this->request = Request::createFromGlobals();
		$this->session = new Session();
		$this->redirect = new Redirect($this->session);
		$this->auth = new Auth($this->session, $this->redirect);
		$this->view = new View($this->session, $this->auth);
		$this->router = new Router(
			$this->request,
			$this->view,
			$this->redirect,
			$this->session,
			$this->auth
		);

	}

}