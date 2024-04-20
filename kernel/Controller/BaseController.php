<?php

namespace Kernel\Controller;

use Kernel\Model\Model;
use Kernel\Http\Request;
use Kernel\View\View;

class BaseController
{
	public Model $database;
	public Request $request;
	public View $view;

	public function setDatabase(Model $database): void
	{
		$this->database = $database;
	}

	public function setRequest(Request $request): void
	{
		$this->request = $request;
	}

	public function setView(View $view): void
	{
		$this->view = $view;
	}
}