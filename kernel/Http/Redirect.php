<?php

namespace Kernel\Http;

use Kernel\Session\Session;

class Redirect
{

	public function __construct(private Session $session)
	{
	}

	public function with(string $key, string $value): self
	{
		$this->session->set($key, $value);
		return $this;
	}

	public function to(string $path): void
	{
		header("Location: {$path}");
		exit();
	}
}