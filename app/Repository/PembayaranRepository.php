<?php 

namespace Noval\UKK\Paket1\Repository;

use Noval\UKK\Paket1\Model\Pembayaran;
use Noval\UKK\Paket1\Model\History;

class PembayaranRepository {

	public function __construct(private \PDO $connection)
	{
		
	}

	public function getAll(string $keyword = ''): ?array
	{
		$result = [];
		$sql = "SELECT pembayaran.id as id, pembayaran.id_petugas, pembayaran.nisn, pembayaran.tgl_bayar, pembayaran.bulan_dibayar, pembayaran.tahun_dibayar, pembayaran.id_spp, pembayaran.jumlah_bayar, siswa.nisn, siswa.nama as nama_siswa, petugas.id as id_petugas, petugas.nama_petugas as nama_petugas, spp.id as id_spp, spp.nominal as nominal FROM `pembayaran` JOIN petugas ON petugas.id = pembayaran.id_petugas JOIN spp ON spp.id = pembayaran.id_spp JOIN siswa ON siswa.nisn = pembayaran.nisn WHERE pembayaran.nisn LIKE '%{$keyword}%' OR siswa.nama LIKE '%{$keyword}%' OR pembayaran.bulan_dibayar LIKE '%{$keyword}%' ORDER BY pembayaran.id DESC";
		$statement = $this->connection->query($sql);
		// $statement->execute([$keyword, $keyword]);
		foreach ($statement->fetchAll() as $row) {
			$history = new History();
			$history->id = $row['id'];
			$history->idPetugas = $row['id_petugas'];
			$history->namaPetugas = $row['nama_petugas'];
			$history->nisn = $row['nisn'];
			$history->namaSiswa = $row['nama_siswa'];
			$history->tglBayar = $row['tgl_bayar'];
			$history->bulanDibayar = $row['bulan_dibayar'];
			$history->tahunDibayar = $row['tahun_dibayar'];
			$history->idSpp = $row['id_spp'];
			$history->nominal = $row['nominal'];
			$history->jumlahBayar = $row['jumlah_bayar'];
			array_push($result, $history);
		}
		// var_dump($result);
		return $result;
	}

	public function save(Pembayaran $pembayaran): ?Pembayaran
	{
		$sql = "INSERT INTO `pembayaran`(`id_petugas`, `nisn`, `tgl_bayar`, `bulan_dibayar`, `tahun_dibayar`, `id_spp`, `jumlah_bayar`) VALUES (?, ?, ?, ?, ?, ?, ?)";
		$statement = $this->connection->prepare($sql);
		$result = $statement->execute([$pembayaran->idPetugas, $pembayaran->nisn, $pembayaran->tglBayar, $pembayaran->bulanDibayar, $pembayaran->tahunDibayar, $pembayaran->idSpp, $pembayaran->jumlahBayar]);
		
		// $statement = $this->connection->query("SELECT id FROM pembayaran ORDER BY id DESC LIMIT 1");
		// var_dump();
		if ($result) {
			// $data = $statement->fetchAll();
			// $pembayaran = new Pembayaran();
			$pembayaran->id = $this->connection->lastInsertId();
			// $pembayaran->idPetugas = $data['id_petugas'];
			// $pembayaran->nisn = $data['nisn'];
			// $pembayaran->tglBayar = $data['tgl_bayar'];
			// $pembayaran->bulanDibayar = $data['bulan_dibayar'];
			// $pembayaran->tahunDibayar = $data['tahun_dibayar'];
			// $pembayaran->idSpp = $data['id_spp'];
			// $pembayaran->jumlahBayar = $data['jumlah_bayar'];
			return $pembayaran;
		}
		return null;
	}

	public function findById(int $id): ?History
	{
		$result = [];
		// var_dump($id);
		$sql = "SELECT pembayaran.id as id, pembayaran.id_petugas, pembayaran.nisn, pembayaran.tgl_bayar, pembayaran.bulan_dibayar, pembayaran.tahun_dibayar, pembayaran.id_spp, pembayaran.jumlah_bayar, siswa.nisn, siswa.nama as nama_siswa, petugas.id as id_petugas, petugas.nama_petugas as nama_petugas, spp.id as id_spp, spp.nominal as nominal FROM `pembayaran` JOIN petugas ON petugas.id = pembayaran.id_petugas JOIN spp ON spp.id = pembayaran.id_spp JOIN siswa ON siswa.nisn = pembayaran.nisn WHERE pembayaran.id = ?";
		$statement = $this->connection->prepare($sql);
		$statement->execute([$id]);
		// var_dump($statement);
		if ($data = $statement->fetch()) {
			$history = new History();
			$history->id = $data['id'];
			$history->idPetugas = $data['id_petugas'];
			$history->namaPetugas = $data['nama_petugas'];
			$history->nisn = $data['nisn'];
			$history->namaSiswa = $data['nama_siswa'];
			$history->tglBayar = $data['tgl_bayar'];
			$history->bulanDibayar = $data['bulan_dibayar'];
			$history->tahunDibayar = $data['tahun_dibayar'];
			$history->idSpp = $data['id_spp'];
			$history->nominal = $data['nominal'];
			$history->jumlahBayar = $data['jumlah_bayar'];
			return $history;
		}
		return null;
	}

	public function findByNisn(string $nisn): ?array
	{
		$result = [];
		$sql = "SELECT pembayaran.id as id, pembayaran.id_petugas, pembayaran.nisn, pembayaran.tgl_bayar, pembayaran.bulan_dibayar, pembayaran.tahun_dibayar, pembayaran.id_spp, pembayaran.jumlah_bayar, siswa.nisn, siswa.nama as nama_siswa, petugas.id as id_petugas, petugas.nama_petugas as nama_petugas, spp.id as id_spp, spp.nominal as nominal FROM `pembayaran` JOIN petugas ON petugas.id = pembayaran.id_petugas JOIN spp ON spp.id = pembayaran.id_spp JOIN siswa ON siswa.nisn = pembayaran.nisn WHERE pembayaran.nisn = ?";
		$statement = $this->connection->prepare($sql);
		$statement->execute([$nisn]);
		foreach ($statement->fetchAll() as $row) {
			$history = new History();
			$history->id = $row['id'];
			$history->idPetugas = $row['id_petugas'];
			$history->namaPetugas = $row['nama_petugas'];
			$history->nisn = $row['nisn'];
			$history->namaSiswa = $row['nama_siswa'];
			$history->tglBayar = $row['tgl_bayar'];
			$history->bulanDibayar = $row['bulan_dibayar'];
			$history->tahunDibayar = $row['tahun_dibayar'];
			$history->idSpp = $row['id_spp'];
			$history->nominal = $row['nominal'];
			$history->jumlahBayar = $row['jumlah_bayar'];
			array_push($result, $history);
		}
		return $result;
	}

	public function findByRangeDate(string $from, string $to): ?array
	{
		$result = [];
		$sql = "SELECT pembayaran.id as id, pembayaran.id_petugas, pembayaran.nisn, pembayaran.tgl_bayar, pembayaran.bulan_dibayar, pembayaran.tahun_dibayar, pembayaran.id_spp, pembayaran.jumlah_bayar, siswa.nisn, siswa.nama as nama_siswa, petugas.id as id_petugas, petugas.nama_petugas as nama_petugas, spp.id as id_spp, spp.nominal as nominal FROM `pembayaran` JOIN petugas ON petugas.id = pembayaran.id_petugas JOIN spp ON spp.id = pembayaran.id_spp JOIN siswa ON siswa.nisn = pembayaran.nisn WHERE pembayaran.tgl_bayar > ? AND pembayaran.tgl_bayar < ?";
		$statement = $this->connection->prepare($sql);
		$statement->execute([$from, $to]);
		foreach ($statement->fetchAll() as $row) {
			$history = new History();
			$history->id = $row['id'];
			$history->idPetugas = $row['id_petugas'];
			$history->namaPetugas = $row['nama_petugas'];
			$history->nisn = $row['nisn'];
			$history->namaSiswa = $row['nama_siswa'];
			$history->tglBayar = $row['tgl_bayar'];
			$history->bulanDibayar = $row['bulan_dibayar'];
			$history->tahunDibayar = $row['tahun_dibayar'];
			$history->idSpp = $row['id_spp'];
			$history->nominal = $row['nominal'];
			$history->jumlahBayar = $row['jumlah_bayar'];
			array_push($result, $history);
		}
		return $result;
	}

	// public function delete(string $nisn)
	// {
	// 	$sql = "DELETE FROM siswa WHERE nisn = $nisn";
	// 	return $statement = $this->connection->exec($sql);
	// }

	// public function findByNisn(string $nisn): ?Siswa
	// {
	// 	$sql = "SELECT nisn, nis, nama, id_kelas, alamat, no_telp, id_spp FROM `siswa` WHERE nisn = ?";
	// 	$statement = $this->connection->prepare($sql);
	// 	$statement->execute([$nisn]);
	// 	if ($data = $statement->fetch()) {
	// 		$siswa = new siswa();
	// 		$siswa->nisn = $data['nisn'];
	// 		$siswa->nis = $data['nis'];
	// 		$siswa->nama = $data['nama'];
	// 		$siswa->alamat = $data['alamat'];
	// 		$siswa->idKelas = $data['id_kelas'];
	// 		$siswa->noTelp = $data['no_telp'];
	// 		$siswa->idSpp = $data['id_spp'];
	// 		return $siswa;
	// 	}
	// 	return null;
	// }

	// public function findByNis(string $nis): ?Siswa
	// {
	// 	$sql = "SELECT nisn, nis, nama, id_kelas, alamat, no_telp, id_spp FROM `siswa` WHERE nis = ?";
	// 	$statement = $this->connection->prepare($sql);
	// 	$statement->execute([$nis]);
	// 	if ($data = $statement->fetch()) {
	// 		$siswa = new siswa();
	// 		$siswa->nisn = $data['nisn'];
	// 		$siswa->nis = $data['nis'];
	// 		$siswa->nama = $data['nama'];
	// 		$siswa->idKelas = $data['id_kelas'];
	// 		$siswa->noTelp = $data['no_telp'];
	// 		$siswa->idSpp = $data['id_spp'];
	// 		return $siswa;
	// 	}
	// 	return null;
	// }

	// public function update(Siswa $siswa, int $oldNisn): ?Petugas
	// {
	// 	$sql = "UPDATE `siswa` SET `nisn` = ?, `nis` = ?, `nama` = ?, `id_kelas` = ?, `alamat` = ?, `no_telp` = ?, `id_spp` = ? WHERE `siswa`.`nisn` = ?";
	// 	$statement = $this->connection->prepare($sql);
	// 	// var_dump($statement);
	// 	// var_dump($oldNisn);
	// 	$statement->execute([$siswa->nisn, $siswa->nis, $siswa->nama, $siswa->idKelas, $siswa->alamat, $siswa->noTelp, $siswa->idSpp, $oldNisn]);

	// 	if ($data = $statement->fetch()) {
	// 		$siswa = new siswa();
	// 		$siswa->nisn = $row['nisn'];
	// 		$siswa->nisn = $row['nisn'];
	// 		$siswa->nama = $row['nama'];
	// 		$siswa->idKelas = $row['id_kelas'];
	// 		$siswa->noTelp = $row['no_telp'];
	// 		$siswa->idSpp = $row['id_spp'];
	// 		return $siswa;
	// 	}
	// 	return null;
	// }
}

 ?>