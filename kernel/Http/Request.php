<?php

namespace Kernel\Http;

class Request
{
	public function __construct(
		public array $get,
		public array $post,
		public array $server,
		public array $cookie,
		public array $files
	)
	{

	}

	public static function createFromGlobals(): static
	{
		return new static($_GET, $_POST, $_SERVER, $_COOKIE, $_FILES);
	}

	public function uri(): string
	{
		return preg_replace('/\?+.*/', '', $this->server['REQUEST_URI']);
	}

	public function method(): string
	{
		return $this->server['REQUEST_METHOD'];
	}

	public function input(string $value): ?string
	{
		return $this->get[$value] ?? $this->post[$value] ?? null;
	}

	public function get(): array
	{
		return $this->get;
	}

	public function post(): array
	{
		return $this->post;
	}

	public function all(): array
	{
		return array_merge($this->get, $this->post);
	}

}