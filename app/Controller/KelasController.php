<?php 

namespace Noval\UKK\Paket1\Controller;

use Noval\UKK\Paket1\App\View;
use Noval\UKK\Paket1\App\Message;
use Noval\UKK\Paket1\Repository\KelasRepository;
use Noval\UKK\Paket1\Service\KelasService;
use Noval\UKK\Paket1\Exception\ValidationException;
use Noval\UKK\Paket1\Model\Kelas;
use Noval\UKK\Paket1\Config\Database;

class KelasController {

	private KelasService $kelasService;

	public function __construct()
	{
		$kelasRepository = new KelasRepository(Database::getConnection());
		$this->kelasService = new KelasService($kelasRepository);
	}

	public function index()
	{
		$keyword = $_GET['search'] ?? '';
		$kelasRepository = new KelasRepository(Database::getConnection());
		$this->kelasService = new KelasService($kelasRepository);
		$result = $this->kelasService->getAll($keyword);
		View::render("Kelas/index", [
			"title" => "Data Kelas",
			"dataKelas" => $result,
		]);
	}

	public function tambah()
	{
		View::render("Kelas/tambah", [
			"title" => "Data Kelas",
			"nama" => $_POST['nama'] ?? '',
			"kompetensiKeahlian" => $_POST['kompetensiKeahlian'] ?? ''
		]);
	}


public function edit(int $id)
	{
		$result = $this->kelasService->cariKelas($id);
		View::render("Kelas/edit", [
			"title" => "Edit Kelas",
			"nama" => $result->nama,
			"kompetensiKeahlian" => $result->kompetensiKeahlian
		]);
	}

	public function postEdit($oldId)
	{
		$kelasRepository = new KelasRepository(Database::getConnection());
		$this->kelasService = new KelasService($kelasRepository);
		try {
			$kelas = new Kelas();
			$kelas->nama = $_POST['nama'] ?? '';
			$kelas->kompetensiKeahlian = $_POST['kompetensiKeahlian'] ?? '';

			$result = $this->kelasService->edit($kelas, $oldId);
			view::redirect("/kelas", "data berhasil diubah!");
		} catch (ValidationException $exception) {
				View::render("Kelas/edit", [
				"title" => "Data Kelas",
				"error" => $exception->getMessage(),
				"nama" => $_POST['nama'] ?? '',
				"kompetensiKeahlian" => $_POST['kompetensiKeahlian'] ?? ''
			]);
		}
		
	}

	public function postTambah()
	{
		$kelasRepository = new KelasRepository(Database::getConnection());
		$this->kelasService = new KelasService($kelasRepository);
		try {
			$kelas = new Kelas();
			$kelas->nama = $_POST['nama'] ?? '';
			$kelas->kompetensiKeahlian = $_POST['kompetensiKeahlian'] ?? '';

			$result = $this->kelasService->simpanData($kelas);
			view::redirect("/kelas", "data berhasil disimpan!");
		} catch (ValidationException $exception) {
				View::render("Kelas/tambah", [
				"title" => "Data Kelas",
				"error" => $exception->getMessage(),
				"nama" => $_POST['nama'] ?? '',
				"kompetensiKeahlian" => $_POST['kompetensiKeahlian'] ?? ''
			]);
		}
		
	}

	public function hapus(int $id)
	{
		$kelasRepository = new KelasRepository(Database::getConnection());
		$this->kelasService = new KelasService($kelasRepository);

		$result = $this->kelasService->delete($id);
		view::redirect("/kelas", "data berhasil dihapus!");
	}
}

 ?>