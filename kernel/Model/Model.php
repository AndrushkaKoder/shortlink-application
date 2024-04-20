<?php

namespace Kernel\Model;

use PDO;

class Model implements DatabaseInterface
{
	private PDO $pdo;
	private array $dbConfig;
	protected string $table;

	public function __construct()
	{
		$this->dbConfig = $this->getConfig();
		$this->connect();
	}

	public static function query(): static
	{
		return new static();
	}

	private function connect(): void
	{
		try {
			$this->pdo = new PDO("mysql:host={$this->dbConfig['host']};
			dbname={$this->dbConfig['db_name']}",
				$this->dbConfig['db_user'],
				$this->dbConfig['db_password']);

		} catch (\Exception $exception) {
			die('Model connect failed. Check params. ' . $exception->getMessage());
		}

	}

	public function insert(array $data): int|false
	{
		$fields = array_keys($data);
		$columns = implode(', ', $fields);

		if (!$columns) return false;

		$bind = implode(', ', array_map(fn($item) => ":$item", array_values($fields)));

		$query = "INSERT INTO {$this->table} ($columns) VALUES ($bind)";

		$sql = $this->pdo->prepare($query);

		$sql->execute($data);

		return $this->pdo->lastInsertId();
	}

	public function select(array $fields = [], array $conditions = []): ?array
	{
		$dbFields = '*';
		$where = '';

		if ($fields) $dbFields = implode(', ', $fields);

		if ($conditions) $where = "WHERE " . implode(' AND ', array_map(function ($item) {
				return "$item = :$item";
			}, array_keys($conditions)));

		$query = "SELECT {$dbFields} FROM {$this->table} {$where}";
		$statement = $this->pdo->prepare($query);
		$statement->execute($conditions);

		return $statement->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function first(array $conditions): ?array
	{
		$where = '';

		if (count($conditions)) {
			$where = "WHERE " . implode(' AND ', array_map(function ($item) {
					return "$item = :$item";
				}, array_keys($conditions)));
		}

		$query = "SELECT * FROM {$this->table} {$where} LIMIT 1";

		$statement = $this->pdo->prepare($query);
		$statement->execute($conditions);

		$first = $statement->fetch(\PDO::FETCH_ASSOC);
		return !$first ? null : $first;
	}

	public function delete(array $conditions = []): void
	{
		$where = '';

		if ($conditions) {
			$where = "WHERE " . implode(' AND ', array_map(function ($item) {
					return "$item = :$item";
				}, array_keys($conditions)));
		}

		$query = "DELETE FROM {$this->table} {$where}";
		$statement = $this->pdo->prepare($query);
		$statement->execute($conditions);
	}

	public function update(int $id, array $conditions = []): void
	{
		$set = '';
		if ($conditions) {
			$set = "SET " . implode(' AND ', array_map(function ($item) {
					return "$item = :$item";
				}, array_keys($conditions)));
		}

		$query = "UPDATE {$this->table} {$set} WHERE id = {$id}";

		$statement = $this->pdo->prepare($query);
		$statement->execute($conditions);
	}

	private function getConfig(): array
	{
		return config('database');
	}
}