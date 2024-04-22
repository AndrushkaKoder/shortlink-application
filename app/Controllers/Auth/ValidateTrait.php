<?php

namespace App\Controllers\Auth;

trait ValidateTrait
{

	private array $registerFields = [
		'name',
		'email',
		'password',
		'password_repeat'
	];

	private array $loginFields = [
		'email',
		'password'
	];

	public function validateData(array $data, bool $isRegister = false): bool|array
	{
		$fields = $isRegister ? $this->registerFields : $this->loginFields;

		if (count($data) < count($fields)) return false;

		foreach ($data as $key => $value) {
			if (!in_array($key, $fields)) return false;
		}

		if ($isRegister) {
			if ($data['password'] !== $data['password_repeat']) return false;
		}

		return $data;
	}

}