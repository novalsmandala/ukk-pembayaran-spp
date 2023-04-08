<?php 

namespace Noval\UKK\Paket1\Controller;

use Noval\UKK\Paket1\App\View;
use Noval\UKK\Paket1\Repository\SppRepository;
use Noval\UKK\Paket1\Service\SppService;
use Noval\UKK\Paket1\Exception\ValidationException;
use Noval\UKK\Paket1\Model\Spp;
use Noval\UKK\Paket1\Config\Database;

class SppController {

	private SppService $sppService;

	public function __construct()
	{
		$sppRepository = new SppRepository(Database::getConnection());
		$this->sppService = new SppService($sppRepository);
	}

	public function index()
	{
		$keyword = $_GET['search'] ?? '';
		$result = $this->sppService->getAll($keyword);
		View::render("Spp/index", [
			"title" => "Data SPP",
			"dataSpp" => $result,
		]);
	}

	public function tambah()
	{
		View::render("Spp/tambah", [
			"title" => "Data Spp",
			"tahun" => $_POST['tahun'] ?? '',
			"nominal" => $_POST['kompetensiKeahlian'] ?? ''
		]);
	}


public function edit(int $id)
	{
		$result = $this->sppService->cariSpp($id);
		View::render("Spp/edit", [
			"title" => "Spp Kelas",
			"tahun" => $result->tahun,
			"nominal" => $result->nominal
		]);
	}

	public function postEdit($oldId)
	{
		try {
			$spp = new Spp();
			$spp->tahun = (int)$_POST['tahun'] ?? '';
			$spp->nominal =(int) $_POST['nominal'] ?? '';

			$result = $this->sppService->edit($spp, $oldId);
			view::redirect("/spp", "data berhasil diubah!");
		} catch (ValidationException $exception) {
				View::render("Spp/edit", [
				"title" => "Data Spp",
				"error" => $exception->getMessage(),
				"tahun" => $_POST['tahun'] ?? '',
				"nominal" => $_POST['nominal'] ?? ''
			]);
		}
		
	}

	public function postTambah()
	{
		try {
			$spp = new Spp();
			$spp->tahun = (int)$_POST['tahun'] ?? '';
			$spp->nominal = (int)$_POST['nominal'] ?? '';

			$result = $this->sppService->simpanData($spp);
			view::redirect("/spp", "data berhasil disimpan!");
		} catch (ValidationException $exception) {
				View::render("Spp/tambah", [
				"title" => "Data SPP",
				"error" => $exception->getMessage(),
				"tahun" => $_POST['tahun'] ?? '',
				"nominal" => $_POST['nominal'] ?? ''
			]);
		}
		
	}

	public function hapus(int $id)
	{
		$result = $this->sppService->delete($id);
		view::redirect("/spp", "data berhasil dihapu!");
	}
}

 ?>