<?php

namespace App\Middlewares;

use Kernel\Middleware\BaseMiddleware;

class RedirectIfAuthMiddleware extends BaseMiddleware
{
	public function handle(): void
	{
		if ($this->auth->check()) $this->redirect->to('/');
	}

}