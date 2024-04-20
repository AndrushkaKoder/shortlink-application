<?php

namespace App\Controllers;

use Kernel\Controller\BaseController;

class IndexController extends BaseController
{
	public function index(): void
	{
		$this->view->page('home');
	}
}