<?php

namespace Kernel\Router;

class Route
{
	public function __construct(
		private string $path,
		private string $method,
		private mixed  $action,
		private array  $middleware = []
	)
	{
	}

	public static function get(string $uri, mixed $action, array $middleware = []): static
	{
		return new static($uri, 'GET', $action, $middleware);
	}

	public static function post(string $uri, mixed $action, array $middleware = []): static
	{
		return new static($uri, 'POST', $action, $middleware);
	}

	public function getUri(): string
	{
		return $this->path;
	}

	public function getAction()
	{
		return $this->action;
	}

	public function getMethod(): string
	{
		return $this->method;
	}

	public function getMiddleware(): array
	{
		return $this->middleware;
	}

}