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
		return new static(
			self::clearFields($_GET),
			self::clearFields($_POST),
			$_SERVER,
			$_COOKIE,
			self::clearFields($_FILES)
		);
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

	public function get($key): mixed
	{
		return !$key ? $this->get : $this->get[$key];
	}

	public function post(string $key = ''): mixed
	{
		return !$key ? $this->post : $this->post[$key];
	}

	public function all(): array
	{
		return array_merge($this->get, $this->post);
	}

	private static function clearFields(array $array): array
	{
		foreach ($array as $key => $value) {
			$array[$key] = htmlspecialchars($value, ENT_QUOTES);
		}
		return $array;
	}
}