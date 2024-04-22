<?php

namespace Kernel\Router;

use Kernel\Auth\Auth;
use Kernel\Http\Redirect;
use Kernel\Http\Request;
use Kernel\Session\Session;
use Kernel\View\View;

class Router
{
	private array $routes = [
		'GET' => [],
		'POST' => []
	];

	public function __construct(
		private Request $request,
		private View    $view,
		private Redirect $redirect,
		private Session $session,
		private Auth $auth,
	)
	{
		$this->initRoutes();
	}

	public function dispatch(string $uri, string $method): void
	{
		$route = $this->findRoute($uri, $method);
		if (!$route) {
			exit(include VIEWS . '/404/404.php');
		}

		if ($route->hasMiddlewares()) {
			foreach ($route->getMiddlewares() as $middleware) {
				$middleware = new $middleware($this->redirect, $this->request, $this->auth);
				$middleware->handle();
			}
		}

		if(is_array($route->getAction())) {
			[$controller, $actionMethod] = $route->getAction();
			$controller = new $controller;
			call_user_func([$controller, 'setRequest'], $this->request);
			call_user_func([$controller, 'setSession'], $this->session);
			call_user_func([$controller, 'setView'], $this->view);
			call_user_func([$controller, 'setRedirect'], $this->redirect);
			call_user_func([$controller, 'setAuth'], $this->auth);
			call_user_func([$controller, $actionMethod]);
		} else {
			call_user_func($route->getAction());
		}
	}

	private function initRoutes(): void
	{
		$routes = $this->getRoutes();

		foreach ($routes as $route) {
			/**
			 * @var Route $route
			 */
			$this->routes[$route->getMethod()][$route->getUri()] = $route;
		}
	}

	private function getRoutes(): array
	{
		return include APP . '/routes/web.php';
	}

	private function findRoute(string $uri, string $method): ?Route
	{
		return $this->routes[$method][$uri] ?? null;
	}

}