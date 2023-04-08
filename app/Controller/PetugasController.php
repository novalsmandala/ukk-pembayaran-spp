<?php 

namespace Noval\UKK\Paket1\Controller;

use Noval\UKK\Paket1\App\View;
use Noval\UKK\Paket1\Repository\PetugasRepository;
use Noval\UKK\Paket1\Service\PetugasService;
use Noval\UKK\Paket1\Exception\ValidationException;
use Noval\UKK\Paket1\Model\Petugas;
use Noval\UKK\Paket1\Config\Database;

class PetugasController {

	private PetugasService $petugasService;

	public function __construct()
	{
		$petugasRepository = new PetugasRepository(Database::getConnection());
		$this->petugasService = new PetugasService($petugasRepository);
	}

	public function index()
	{
		$keyword = $_GET['search'] ?? '';
		$result = $this->petugasService->getAll($keyword);
		View::render("Petugas/index", [
			"title" => "Data Petugas",
			"dataPetugas" => $result,
		]);
	}

	public function tambah()
	{
		View::render("Petugas/tambah", [
			"title" => "Data Petugas",
			"username" => $_POST['username'] ?? '',
			"namaLengkap" => $_POST['namaLengkap'] ?? '',
			"level" => $_POST['level'] ?? ''
		]);
	}


public function edit(int $id)
	{
		$result = $this->petugasService->cariPetugas($id);
		View::render("Petugas/edit", [
			"title" => "Data Petugas",
			"username" => $result->username,
			"namaLengkap" => $result->namaLengkap,
			"level" => $result->level
		]);
	}

	public function postEdit($oldId)
	{
		try {
			$petugas = new Petugas();
			$petugas->username = $_POST['username'] ?? '';
			$petugas->password = $_POST['namaLengkap'] ?? '';
			$petugas->namaLengkap = $_POST['namaLengkap'] ?? '';
			$petugas->level = $_POST['level'] ?? '';

			$result = $this->petugasService->edit($petugas, $oldId);
			view::redirect("/petugas", "data berhasil diubah!");
		} catch (ValidationException $exception) {
				View::render("Petugas/edit", [
				"title" => "Ubah Petugas",
				"error" => $exception->getMessage(),
				"username" => $_POST['username'] ?? '',
				"password" => $_POST['password'] ?? '',
				"namaLengkap" => $_POST['namaLengkap'] ?? '',
				"level" => $_POST['level'] ?? ''
			]);
		}
		
	}

	public function postTambah()
	{
		try {
			$petugas = new Petugas();
			$petugas->username = $_POST['username'] ?? '';
			$petugas->password = $_POST['namaLengkap'] ?? '';
			$petugas->namaLengkap = $_POST['namaLengkap'] ?? '';
			$petugas->level = $_POST['level'] ?? '';

			$result = $this->petugasService->simpanData($petugas);
			view::redirect("/petugas", "data berhasil disimpan!");
		} catch (ValidationException $exception) {
				View::render("Petugas/tambah", [
				"error" => $exception->getMessage(),
				"username" => $_POST['username'] ?? '',
				"password" => $_POST['password'] ?? '',
				"namaLengkap" => $_POST['namaLengkap'] ?? '',
				"level" => $_POST['level'] ?? ''
			]);
		}
		
	}

	public function hapus(int $id)
	{
		$result = $this->petugasService->delete($id);
		view::redirect("/petugas", "data berhasil dihapus!");
	}
}

 ?>