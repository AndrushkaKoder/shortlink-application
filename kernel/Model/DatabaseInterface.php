<?php

namespace Kernel\Model;

interface DatabaseInterface
{
	public function insert(array $data): int|false;

	public function select(array $fields = [], array $conditions = []): ?array;

	public function first(array $conditions): ?array;

	public function delete(array $conditions = []): void;

	public function update(int $id, array $conditions = []): void;
}