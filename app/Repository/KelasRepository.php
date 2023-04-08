<?php 

namespace Noval\UKK\Paket1\Repository;

use Noval\UKK\Paket1\Model\Kelas;

class KelasRepository {

	public function __construct(private \PDO $connection)
	{
		
	}

	public function getAll(string $keyword = ''): ?array
	{
		$result = [];
		$sql = "SELECT * FROM kelas WHERE nama LIKE '%{$keyword}%' OR kempetensi_keahlian LIKE '%{$keyword}%'";
		$statement = $this->connection->query($sql);
		// $statement->execute([$keyword, $keyword]);
		foreach ($statement->fetchAll() as $row) {
			$kelas = new Kelas();
			$kelas->id = $row['id'];
			$kelas->nama = $row['nama'];
			$kelas->kompetensiKeahlian = $row['kempetensi_keahlian'];
			array_push($result, $kelas);
		}
		// var_dump($result);
		return $result;
	}

	public function save(Kelas $kelas): ?Kelas
	{
		$sql = "INSERT INTO kelas(nama, kempetensi_keahlian) VALUES (? , ?)";
		$statement = $this->connection->prepare($sql);
		$statement->execute([$kelas->nama, $kelas->kompetensiKeahlian]);
		if ($data = $statement->fetch()) {
			$kelas = new Kelas();
			$kelas->nama = $data['nama'];
			$kelas->kompetensiKeahlian = $data['kempetensi_keahlian'];
			return $kelas;
		}
		return null;
	}

	public function delete(int $id)
	{
		$sql = "DELETE FROM kelas WHERE id = $id";
		$statement = $this->connection->exec($sql);
	}

	public function findById(int $id): Kelas
	{
		$sql = "SELECT `id`, `nama`, `kempetensi_keahlian` FROM `kelas` WHERE id = ?";
		$statement = $this->connection->prepare($sql);
		$statement->execute([$id]);
		if ($data = $statement->fetch()) {
			$kelas = new Kelas();
			$kelas->id = $data['id'];
			$kelas->nama = $data['nama'];
			$kelas->kompetensiKeahlian = $data['kempetensi_keahlian'];
			return $kelas;
		}
		return null;
	}

	public function update(Kelas $kelas, int $oldId): ?Kelas
	{
		$sql = "UPDATE `kelas` SET `nama`= ?,`kempetensi_keahlian`= ? WHERE id = $oldId";
		$statement = $this->connection->prepare($sql);
		$statement->execute([$kelas->nama, $kelas->kompetensiKeahlian]);
		if ($data = $statement->fetch()) {
			$kelas = new Kelas();
			$kelas->nama = $data['nama'];
			$kelas->kompetensiKeahlian = $data['kempetensi_keahlian'];
			return $kelas;
		}
		return null;
	}
}

 ?>