<?php

namespace Kernel\Container;

use Kernel\Http\Request;
use Kernel\Router\Router;
use Kernel\View\View;

class Container
{

	public Request $request;
	public Router $router;
	public View $view;

	public function __construct()
	{
		$this->registerServices();
	}

	private function registerServices(): void
	{
		$this->request = Request::createFromGlobals();
		$this->view = new View();
		$this->router = new Router($this->request, $this->view);

	}

}