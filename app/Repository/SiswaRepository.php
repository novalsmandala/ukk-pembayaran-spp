<?php 

namespace Noval\UKK\Paket1\Repository;

use Noval\UKK\Paket1\Model\Siswa;

class SiswaRepository {

	public function __construct(private \PDO $connection) {}

	public function getAll(string $keyword = ''): ?array
	{
		$result = [];
		$sql = "SELECT * FROM siswa WHERE nisn LIKE '%{$keyword}%' OR nis LIKE '%{$keyword}%' OR nama LIKE '%{$keyword}%'";
		$statement = $this->connection->query($sql);
		
		foreach ($statement->fetchAll() as $row) {
			$siswa = new siswa();
			$siswa->nisn = $row['nisn'];
			$siswa->nis = $row['nis'];
			$siswa->nama = $row['nama'];
			$siswa->idKelas = $row['id_kelas'];
			$siswa->alamat = $row['alamat'];
			$siswa->noTelp = $row['no_telp'];
			$siswa->idSpp = $row['id_spp'];
			array_push($result, $siswa);
		}
		
		return $result;
	}

	public function save(Siswa $siswa): ?Siswa
	{
		$sql = "INSERT INTO siswa(nisn, nis, nama, id_kelas, alamat, no_telp, id_spp) VALUES (?, ?, ?, ?, ?, ?, ?)";
		$statement = $this->connection->prepare($sql);
		$statement->execute([ 
				$siswa->nisn, 
				$siswa->nis, 
				$siswa->nama, 
				$siswa->idKelas, 
				$siswa->alamat, 
				$siswa->noTelp, 
				$siswa->idSpp]);
		if ($data = $statement->fetch()) {
			$siswa = new siswa();
			$siswa->nisn = $data['nisn'];
			$siswa->nis	 = $data['nis'];
			$siswa->nama = $data['nama'];
			$siswa->idKelas = $data['id_kelas'];
			$siswa->noTelp = $data['no_telp'];
			$siswa->idSpp = $data['id_spp'];
			return $siswa;
		}
		return null;
	}

	public function delete(string $nisn)
	{
		$sql = "DELETE FROM siswa WHERE nisn = $nisn";
		return $this->connection->exec($sql);
	}

	public function findByNisn(string $nisn): ?Siswa
	{
		$sql = "SELECT nisn, nis, nama, id_kelas, alamat, no_telp, id_spp FROM `siswa` WHERE nisn = ?";
		$statement = $this->connection->prepare($sql);
		$statement->execute([$nisn]);
		if ($data = $statement->fetch()) {
			$siswa = new siswa();
			$siswa->nisn = $data['nisn'];
			$siswa->nis = $data['nis'];
			$siswa->nama = $data['nama'];
			$siswa->alamat = $data['alamat'];
			$siswa->idKelas = $data['id_kelas'];
			$siswa->noTelp = $data['no_telp'];
			$siswa->idSpp = $data['id_spp'];
			return $siswa;
		}
		return null;
	}

	public function findByNis(string $nis): ?Siswa
	{
		$sql = "SELECT nisn, nis, nama, id_kelas, alamat, no_telp, id_spp FROM `siswa` WHERE nis = ?";
		$statement = $this->connection->prepare($sql);
		$statement->execute([$nis]);
		if ($data = $statement->fetch()) {
			$siswa = new siswa();
			$siswa->nisn = $data['nisn'];
			$siswa->nis = $data['nis'];
			$siswa->nama = $data['nama'];
			$siswa->idKelas = $data['id_kelas'];
			$siswa->noTelp = $data['no_telp'];
			$siswa->idSpp = $data['id_spp'];
			return $siswa;
		}
		return null;
	}

	public function update(Siswa $siswa, int $oldNisn): ?Siswa
	{
		$sql = "UPDATE `siswa` SET `nisn` = ?, `nis` = ?, `nama` = ?, `id_kelas` = ?, `alamat` = ?, `no_telp` = ?, `id_spp` = ? WHERE `siswa`.`nisn` = ?";
		$statement = $this->connection->prepare($sql);
		$statement->execute([$siswa->nisn, $siswa->nis, $siswa->nama, $siswa->idKelas, $siswa->alamat, $siswa->noTelp, $siswa->idSpp, $oldNisn]);
		if ($data = $statement->fetch()) {
			$siswa = new siswa();
			$siswa->nisn = $data['nisn'];
			$siswa->nis = $data['nis'];
			$siswa->nama = $data['nama'];
			$siswa->idKelas = $data['id_kelas'];
			$siswa->noTelp = $data['no_telp'];
			$siswa->idSpp = $data['id_spp'];
			return $siswa;
		}
		return null;
	}
}

 ?>