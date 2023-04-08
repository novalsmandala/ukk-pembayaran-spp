<?php 

namespace Noval\UKK\Paket1\Repository;

use Noval\UKK\Paket1\Model\Spp;

class SppRepository {

	public function __construct(private \PDO $connection)
	{
		
	}

	public function getAll(string $keyword = ''): ?array
	{
		$result = [];
		$sql = "SELECT * FROM spp WHERE tahun LIKE '%{$keyword}%'";
		$statement = $this->connection->query($sql);
		// $statement->execute([$keyword, $keyword]);
		foreach ($statement->fetchAll() as $row) {
			$spp = new Spp();
			$spp->id = $row['id'];
			$spp->tahun = $row['tahun'];
			$spp->nominal = $row['nominal'];
			array_push($result, $spp);
		}
		return $result;
	}

	public function save(Spp $spp): ?Spp
	{
		$sql = "INSERT INTO spp(tahun, nominal) VALUES (? , ?)";
		$statement = $this->connection->prepare($sql);
		$statement->execute([$spp->tahun, $spp->nominal]);
		if ($data = $statement->fetch()) {
			$spp = new Spp();
			$spp->tahun = $data['tahun'];
			$spp->nominal = $data['nominal'];
			return $spp;
		}
		return null;
	}

	public function delete(int $id)
	{
		$sql = "DELETE FROM spp WHERE id = $id";
		$statement = $this->connection->exec($sql);
	}

	public function findById(int $id): ?Spp
	{
		$sql = "SELECT `id`, `tahun`, `nominal` FROM `spp` WHERE id = ?";
		$statement = $this->connection->prepare($sql);
		$statement->execute([$id]);
		if ($data = $statement->fetch()) {
			$spp = new Spp();
			$spp->id = $data['id'];
			$spp->tahun = $data['tahun'];
			$spp->nominal = $data['nominal'];
			return $spp;
		}
		return null;
	}

	public function update(Spp $kelas, int $oldId): ?Spp
	{
		$sql = "UPDATE `spp` SET `tahun`= ?,`nominal`= ? WHERE id = $oldId";
		$statement = $this->connection->prepare($sql);
		$statement->execute([$kelas->tahun, $kelas->nominal]);
		if ($data = $statement->fetch()) {
			$spp = new Spp();
			$spp->tahun = $data['tahun'];
			$spp->nominal = $data['nominal'];
			return $spp;
		}
		return null;
	}
}

 ?>