<?php

namespace Kernel\Middleware;

use Kernel\Auth\Auth;
use Kernel\Http\Redirect;
use Kernel\Http\Request;

abstract class BaseMiddleware
{

	public function __construct(
		public Redirect $redirect,
		public Request $request,
		public Auth $auth
	)
	{
	}

	public function handle(): void
	{

	}
}