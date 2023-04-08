<?php 

namespace Noval\UKK\Paket1\Controller;

use Noval\UKK\Paket1\App\View;
use Noval\UKK\Paket1\Repository\SiswaRepository;
use Noval\UKK\Paket1\Repository\KelasRepository;
use Noval\UKK\Paket1\Repository\PetugasRepository;
use Noval\UKK\Paket1\Service\SiswaService;
use Noval\UKK\Paket1\Service\KelasService;
use Noval\UKK\Paket1\Service\PetugasService;
use Noval\UKK\Paket1\Exception\ValidationException;
use Noval\UKK\Paket1\Model\Siswa;
use Noval\UKK\Paket1\Config\Database;

class HomeController {

	private SiswaService $siswaService;
	private PetugasService $petugasService;

	public function __construct()
	{	
		$siswaRepository = new SiswaRepository(Database::getConnection());
		$this->siswaService = new SiswaService($siswaRepository);

		$petugasRepository = new PetugasRepository(Database::getConnection());
		$this->petugasService = new PetugasService($petugasRepository);

		
	}

	public function index()
	{
		View::render("Home/index");
	}

	public function login($value='')
	{
		View::render("Home/login-siswa", [], false);
	}

	public function postLogin($value='')
	{
		$nis = $_POST['nis'] ?? '';
		$nama = $_POST['nama'] ?? '';

		try {
			$siswa = $this->siswaService->login($nis, $nama);
			
			session_start();
			$_SESSION['login'] = true;
			$_SESSION['role'] = 'siswa';
			$_SESSION['nisn'] = $siswa->nisn;
			$_SESSION['username'] = $siswa->nama;
			View::redirect("/home");		
		} catch (ValidationException $exception) {
			View::render("Home/login-siswa", [
				"error" => $exception->getMessage(),
				"nis" => $nis,
				"nama" => $nama
			], false);
		}
		
	}

	public function loginPetugas($value='')
	{
		View::render("Home/login-petugas", [], false);
	}

	public function postLoginPetugas($value='')
	{
		$username = $_POST['username'] ?? '';
		$password = $_POST['password'] ?? '';
		try {
			$petugas = $this->petugasService->login($username, $password);
			
			session_start();
			$_SESSION['login'] = true;
			$_SESSION['role'] = $petugas->level;
			$_SESSION['id'] = $petugas->id;
			$_SESSION['username'] = $petugas->username;
			View::redirect("/home");		
		} catch (ValidationException $exception) {
			View::render("Home/login-petugas", [
				"error" => $exception->getMessage(),
				"username" => $username,
			], false);
		}
	}

	public function logout()
	{	
		session_start();
		session_destroy();
		View::redirect("/login");
	}
}

 ?>