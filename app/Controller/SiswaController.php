<?php 

namespace Noval\UKK\Paket1\Controller;

use Noval\UKK\Paket1\App\View;
use Noval\UKK\Paket1\Repository\SiswaRepository;
use Noval\UKK\Paket1\Repository\KelasRepository;
use Noval\UKK\Paket1\Repository\SppRepository;
use Noval\UKK\Paket1\Service\SiswaService;
use Noval\UKK\Paket1\Service\KelasService;
use Noval\UKK\Paket1\Service\SppService;
use Noval\UKK\Paket1\Exception\ValidationException;
use Noval\UKK\Paket1\Model\Siswa;
use Noval\UKK\Paket1\Config\Database;
use PDOException;

class SiswaController {

	private SiswaService $siswaService;
	private KelasService $kelasService;
	private SppService $sppService;

	public function __construct()
	{
		$siswaRepository = new SiswaRepository(Database::getConnection());
		$this->siswaService = new SiswaService($siswaRepository);
		$kelasRepository = new KelasRepository(Database::getConnection());
		$this->kelasService = new KelasService($kelasRepository);
		$sppRepository = new SppRepository(Database::getConnection());
		$this->sppService = new SppService($sppRepository);
	}

	public function index()
	{
		$keyword = $_GET['search'] ?? '';
		$result = $this->siswaService->getAll($keyword);
		View::render("Siswa/index", [
			"title" => "Data Siswa",
			"dataSiswa" => $result,
		]);
	}

	public function tambah()
	{

		$kelas = $this->kelasService->getAll();
		$spp = $this->sppService->getAll();
		View::render("Siswa/tambah", [
			"title" => "Tambah Siswa",
			"dataKelas" => $kelas,
			"dataSpp" => $spp,
			"nisn" => $_POST['nisn'] ?? '',
			"nis" => $_POST['nis'] ?? '',
			"idKelas" => $_POST['idKelas'] ?? '',
			"alamat" => $_POST['alamat'] ?? '',
			"noTelp" => $_POST['noTelp'] ?? '',
			"idSpp" => $_POST['idSpp'] ?? ''
		]);
	}


public function edit(string $nisn)
	{
		$siswa = $this->siswaService->cariSiswa($nisn);
		$kelas = $this->kelasService->getAll();
		$kelasTerakhir = $this->kelasService->cariKelas($siswa->idKelas);
		$spp = $this->sppService->getAll();
		$sppTerakhir = $this->sppService->cariSpp($siswa->idSpp);
		View::render("Siswa/edit", [
			"dataKelas" => $kelas,
			"kelasTerakhir" => $kelasTerakhir,
			"dataSpp" => $spp,
			"sppTerakhir" => $sppTerakhir,
			"title" => "Edit Siswa",
			"nisn" => $siswa->nisn,
			"nis" => $siswa->nis,
			"nama" => $siswa->nama,
			"idKelas" => $siswa->idKelas,
			"alamat" => $siswa->alamat,
			"noTelp" => $siswa->noTelp,
			"idSpp" => $siswa->idSpp
		]);
	}

	public function postEdit(string $oldNisn)
	{
		try {
			$siswa = new Siswa();
			$siswa->nisn =  $_POST['nisn'] ?? '';
			$siswa->nis = $_POST['nis'] ?? '';
			$siswa->nama = $_POST['nama'] ?? '';
			$siswa->idKelas = (int)$_POST['idKelas'] ?? '';
			$siswa->alamat = $_POST['alamat'] ?? '';
			$siswa->noTelp = $_POST['noTelp'] ?? '';
			$siswa->idSpp = (int)$_POST['idSpp'] ?? '';

			$result = $this->siswaService->edit($siswa, $oldNisn );
			view::redirect("/siswa", "data berhasil diubah!");
		} catch (ValidationException $exception) {
				$kelas = $this->kelasService->getAll();
				$spp = $this->sppService->getAll();
				View::render("Siswa/edit", [
				"title" => "Ubah Siswa",
				"dataKelas" => $kelas,
				"dataSpp" => $spp,
				"error" => $exception->getMessage(),
				"nisn" => $_POST['nisn'] ?? '',
				"nis" => $_POST['nis'] ?? '',
				"nama" => $_POST['nama'] ?? '',
				"idKelas" => $_POST['idKelas'] ?? '',
				"alamat" => $_POST['alamat'] ?? '',
				"noTelp" => $_POST['noTelp'] ?? '',
				"idSpp" => $_POST['idSpp'] ?? ''
			]);
		}
		
	}

	public function postTambah()
	{
		try {
			$siswa = new Siswa();
			$siswa->nisn =  $_POST['nisn'] ?? '';
			$siswa->nis = $_POST['nis'] ?? '';
			$siswa->nama = $_POST['nama'] ?? '';
			$siswa->idKelas = (int)$_POST['idKelas'] ?? '';
			$siswa->alamat = $_POST['alamat'] ?? '';
			$siswa->noTelp = $_POST['noTelp'] ?? '';
			$siswa->idSpp = (int)$_POST['idSpp'] ?? '';

			$result = $this->siswaService->simpanData($siswa);
			view::redirect("/siswa", "data berhasil disimpan!");
		} catch (ValidationException $exception) {
				$kelas = $this->kelasService->getAll();
				$spp = $this->sppService->getAll();
				View::render("Siswa/tambah", [
				"dataKelas" => $kelas,
				"dataSpp" => $spp,
				"error" => $exception->getMessage(),
				"nisn" => $_POST['nisn'] ?? '',
				"nis" => $_POST['nis'] ?? '',
				"nama" => $_POST['nama'] ?? '',
				"idKelas" => $_POST['idKelas'] ?? '',
				"alamat" => $_POST['alamat'] ?? '',
				"noTelp" => $_POST['noTelp'] ?? '',
				"idSpp" => $_POST['idSpp'] ?? ''
			]);
		}
		
	}

	public function hapus(string $nisn)
	{
		try {
			$this->siswaService->delete($nisn);
			view::redirect("/siswa", "data berhasil dihapus!");
		} catch (PDOException $e) {
			view::redirect("/siswa", "siswa {$nisn} tidak bisa dihapus!");
		}
	}
}

 ?>