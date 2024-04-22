<?php

namespace Kernel\View;

use Kernel\Auth\Auth;
use Kernel\Exceptions\ViewNotFoundException;
use Kernel\Session\Session;

class View
{

	public function __construct(
		public Session $session,
		public Auth $auth
	)
	{
	}

	public function page(string $path, array $data = []): void
	{
		$viewFile = VIEWS . '/' . dotNotation($path);
		try {
			if (file_exists($viewFile)) {
				extract(array_merge($this->defaultData(), $data));
				include $viewFile;
			} else {
				throw new ViewNotFoundException();
			}
		} catch (ViewNotFoundException $exception) {
			exit("VIEW {$viewFile} NOT FOUND: " . $exception->getMessage());
		}
	}

	public function component(string $pathToComponent, array $data = []): void
	{
		$component = VIEWS . '/' . dotNotation($pathToComponent);
		if (file_exists($component)) {
			extract(array_merge($this->defaultData(), $data));
			include $component;
		} else {
			echo "Component {$pathToComponent} not found!";
		}
	}

	private function defaultData(): array
	{
		return [
			'view' => $this,
			'session' => $this->session,
			'auth' => $this->auth
		];
	}
}