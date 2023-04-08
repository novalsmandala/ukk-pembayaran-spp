<?php 

namespace Noval\UKK\Paket1\Controller;

use Noval\UKK\Paket1\App\View;
use Noval\UKK\Paket1\Repository\SiswaRepository;
use Noval\UKK\Paket1\Repository\KelasRepository;
use Noval\UKK\Paket1\Repository\SppRepository;
use Noval\UKK\Paket1\Repository\PembayaranRepository;
use Noval\UKK\Paket1\Repository\PetugasRepository;
use Noval\UKK\Paket1\Service\PembayaranService;
use Noval\UKK\Paket1\Service\KelasService;
use Noval\UKK\Paket1\Service\SiswaService;
use Noval\UKK\Paket1\Service\SppService;
use Noval\UKK\Paket1\Service\PetugasService;
use Noval\UKK\Paket1\Exception\ValidationException;
use Noval\UKK\Paket1\Model\Petugas;
use Noval\UKK\Paket1\Model\Pembayaran;
use Noval\UKK\Paket1\Config\Database;

class PembayaranController {

	private PembayaranService $pembayaranService;
	private SiswaService $siswaService;
	private KelasService $kelasService;
	private SppService $sppService;
	private PetugasService $petugasService;

	public function __construct()
	{
		$pembayaranRepository = new PembayaranRepository(Database::getConnection());
		$this->pembayaranService = new PembayaranService($pembayaranRepository);

		$siswaRepository = new SiswaRepository(Database::getConnection());
		$this->siswaService = new SiswaService($siswaRepository);
		$kelasRepository = new KelasRepository(Database::getConnection());
		$this->kelasService = new KelasService($kelasRepository);
		$sppRepository = new SppRepository(Database::getConnection());
		$this->sppService = new SppService($sppRepository);
		$petugasRepository = new PetugasRepository(Database::getConnection());
		$this->petugasService = new PetugasService($petugasRepository);
	}

	public function index()
	{
		if ($_SESSION['role'] == 'siswa') {
			$this->historySiswa();
		} else {
			$keyword = $_GET['search'] ?? '';
			$result = $this->pembayaranService->getAll($keyword);
			View::render("Pembayaran/history", [
				"title" => "Data Pembayaran",
				"dataHistory" => $result,
			]);
		}
		
	}

	public function historySiswa()
	{
		$pembayaran = $this->pembayaranService->cariPembayaranByNisn($_SESSION['nisn']);
		$siswa = $this->siswaService->cariSiswa($_SESSION['nisn']);
		View::render("Pembayaran/history-siswa", [
			"title" => "Data Pembayaran",
			"dataPembayaran" => $pembayaran,
			"dataSiswa" => $siswa
		]);
	
	}

	public function cetak(int $id)
	{
		$pembayaran = $this->pembayaranService->cariPembayaran($id);
		$siswa = $this->siswaService->cariSiswa($pembayaran->nisn);
		View::render("Pembayaran/cetak", [
			"title" => "Data Pembayaran",
			"dataPembayaran" => $pembayaran,
			// "dataSiswa" => $siswa,
		], false);
	}

	public function laporan()
	{
		$result = $this->pembayaranService->getAll();
		View::render("Pembayaran/laporan", [
			"title" => "Cetak Pembayaran",
			"data" => $result,
		]);
	}

	public function cetakLaporan()
	{
		$from = $_GET['from'] ?? date("Y-m-d");
		$to = $_GET['to'] ?? date("Y-m-d");
		$result = $this->pembayaranService->getAllByRange($from, $to);
		View::render("Pembayaran/cetak-laporan", [
			"title" => "Cetak Pembayaran",
			"data" => $result,
		], false);
	}
	public function pilihSiswa()
	{
		$keyword = $_GET['search'] ?? '';
		$result = $this->siswaService->getAll($keyword);
		View::render("Pembayaran/pilih-siswa", [
			"title" => "Pilih Siswa",
			"dataSiswa" => $result,
		]);
	}

	public function tambah(string $nisn)
	{
		$siswa = $this->siswaService->cariSiswa($nisn);
		$spp = $this->sppService->cariSpp($siswa->idSpp);
		$kelas = $this->kelasService->cariKelas($siswa->idKelas);
		$result = $this->pembayaranService->getAll();
		View::render("Pembayaran/tambah", [
			"title" => "Tambah Pembayaran",
			"nisn" => $nisn,
			"spp" => $spp,
			"kelas" => $kelas,
		]);
	}

	public function postTambah(string $nisn)
	{
		try {
			$pembayaran = new Pembayaran();
			$pembayaran->idPetugas = $_SESSION['id'] ?? '';
			$pembayaran->nisn = $_POST['nisn'] ?? '';
			$pembayaran->tglBayar = $_POST['tglBayar'] ?? '';
			$pembayaran->bulanDibayar = $_POST['bulanDibayar'] ?? '';
			$pembayaran->tahunDibayar = (int)$_POST['tahunDibayar'] ?? '';
			$pembayaran->idSpp = $_POST['idSpp'] ?? '';
			$pembayaran->jumlahBayar = $_POST['jumlahBayar'] ?? '';

			$result = $this->pembayaranService->simpanData($pembayaran);
			view::redirect("/pembayaran/berhasil/{$result->id}");
		} catch (ValidationException $exception) {
			$siswa = $this->siswaService->cariSiswa($nisn);
			$spp = $this->sppService->cariSpp($siswa->idSpp);
			$kelas = $this->kelasService->cariKelas($siswa->idKelas);
			$result = $this->pembayaranService->getAll();
				View::render("Pembayaran/tambah	", [
				"error" => $exception->getMessage(),
				"nisn" => $nisn,
				"spp" => $spp,
				"kelas" => $kelas,
				"bulanDibayar" => $_POST['bulanDibayar'] ?? '',
				"tahunDibayar" => $_POST['tahunDibayar'] ?? ''
			]);
		}	
	}
	
	public function berhasil($id)
	{
		$result = $this->pembayaranService->cariPembayaran($id);
		View::render("Pembayaran/success", [
			"title" => "Data Pembayaran",
			"dataPembayaran" => $result,
			"id" => $id
		]);
	}

	public function hapus(int $id)
	{
		$this->petugasService->delete($id);
		view::redirect("/pembayaran", "data berhasil dihapus!");
	}
}

 ?>