<?php

namespace Kernel\Session;

class Session
{
	public function set(string $key, string $value): void
	{
		$_SESSION[$key] = $value;
	}

	public function get(string $key): ?string
	{
		return $_SESSION[$key] ?? null;
	}

	public function getFlash(string $key): string
	{
		$value = $this->get($key);
		if ($value) $this->delete($key);
		return $value;
	}

	public function delete($key): void
	{
		unset($_SESSION[$key]);
	}

	public function has($key): bool
	{
		return isset($_SESSION[$key]);
	}

	public function destroy(): void
	{
		session_destroy();
	}
}