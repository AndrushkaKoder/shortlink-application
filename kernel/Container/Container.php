<?php

namespace Kernel\Container;

use Kernel\Model\Model;
use Kernel\Http\Request;
use Kernel\Router\Router;
use Kernel\View\View;

class Container
{

	public Request $request;
	public Router $router;
	public Model $database;
	public View $view;

	public function __construct()
	{
		$this->registerServices();
	}

	private function registerServices(): void
	{
		$this->request = Request::createFromGlobals();
		$this->database = new Model();
		$this->view = new View();
		$this->router = new Router($this->database, $this->request, $this->view);

	}

}