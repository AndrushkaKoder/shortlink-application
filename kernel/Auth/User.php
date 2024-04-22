<?php

namespace Kernel\Auth;

use App\Models\Link;

class User
{
	public function __construct(
		public int $id,
		public string $name,
		public string $email,
	)
	{
	}

	public function name(): string
	{
		return $this->name;
	}

	public function email(): string
	{
		return $this->email;
	}

	public function id(): int
	{
		return $this->id;
	}

	public function links(): ?array
	{
		return Link::query()->select([], [
			'user_id' => $this->id()
		]);
	}

}