<?php

namespace Kernel;

use Kernel\Container\Container;

final class App
{
	private Container $container;

	public function __construct()
	{
		$this->container = new Container();
	}

	public function run(): void
	{
		$request = $this->container->request;
		$this->container->router->dispatch($request->uri(), $request->method());
	}

}