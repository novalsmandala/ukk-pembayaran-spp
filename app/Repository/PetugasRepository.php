<?php 

namespace Noval\UKK\Paket1\Repository;

use Noval\UKK\Paket1\Model\Petugas;

class PetugasRepository {

	public function __construct(private \PDO $connection)
	{
		
	}

	public function getAll(string $keyword = ''): ?array
	{
		$result = [];
		$sql = "SELECT * FROM petugas WHERE username LIKE '%{$keyword}%'";
		$statement = $this->connection->query($sql);
		// $statement->execute([$keyword, $keyword]);
		foreach ($statement->fetchAll() as $row) {
			$petugas = new Petugas();
			$petugas->id = $row['id'];
			$petugas->username = $row['username'];
			$petugas->password = $row['password'];
			$petugas->namaLengkap = $row['nama_petugas'];
			$petugas->level = $row['level'];
			array_push($result, $petugas);
		}
		// var_dump($result);
		return $result;
	}

	public function save(Petugas $petugas): ?Petugas
	{
		$sql = "INSERT INTO petugas(username, password, nama_petugas, level) VALUES (?, ?, ?, ?)";
		$statement = $this->connection->prepare($sql);
		$statement->execute([$petugas->username, $petugas->password, $petugas->namaLengkap, $petugas->level]);
		if ($data = $statement->fetch()) {
			$petugas = new Petugas();
			$petugas->id = $row['id'];
			$petugas->username = $row['username'];
			$petugas->password = $row['password'];
			$petugas->namaLengkap = $row['nama_petugas'];
			$petugas->level = $row['level'];
			return $petugas;
		}
		return null;
	}

	public function delete(int $id)
	{
		$sql = "DELETE FROM petugas WHERE id = $id";
		$statement = $this->connection->exec($sql);
	}

	public function findById(int $id): ?Petugas
	{
		$sql = "SELECT id, username, password, nama_petugas, level FROM `petugas` WHERE id = ?";
		$statement = $this->connection->prepare($sql);
		$statement->execute([$id]);
		if ($data = $statement->fetch()) {
			$petugas = new Petugas();
			$petugas->id = $data['id'];
			$petugas->username = $data['username'];
			$petugas->password = $data['password'];
			$petugas->namaLengkap = $data['nama_petugas'];
			$petugas->level = $data['level'];
			return $petugas;
		}
		return null;
	}

	public function findByUsername(string $username): ?Petugas
	{
		$sql = "SELECT id, username, password, nama_petugas, level FROM `petugas` WHERE username = ?";
		$statement = $this->connection->prepare($sql);
		$statement->execute([$username]);
		if ($data = $statement->fetch()) {
			$petugas = new Petugas();
			$petugas->id = $data['id'];
			$petugas->username = $data['username'];
			$petugas->password = $data['password'];
			$petugas->namaLengkap = $data['nama_petugas'];
			$petugas->level = $data['level'];
			return $petugas;
		}
		return null;
	}

	public function update(Petugas $petugas, int $oldId): ?Petugas
	{
		$sql = "UPDATE `petugas` SET `username`= ?,`password`= ?,`nama_petugas`= ?,`level`= ? WHERE id = ?";
		$statement = $this->connection->prepare($sql);
		var_dump($statement);
		$statement->execute([$petugas->username, $petugas->password, $petugas->namaLengkap, $petugas->level, $oldId]);

		if ($data = $statement->fetch()) {
			$petugas = new Petugas();
			$petugas->id = $row['id'];
			$petugas->username = $row['username'];
			$petugas->password = $row['password'];
			$petugas->namaLengkap = $row['nama_petugas'];
			$petugas->level = $row['level'];
			return $petugas;
		}
		return null;
	}
}

 ?>