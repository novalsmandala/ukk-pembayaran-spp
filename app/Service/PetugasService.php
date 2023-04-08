<?php 

namespace Noval\UKK\Paket1\Service;

use Noval\UKK\Paket1\Repository\PetugasRepository;
use Noval\UKK\Paket1\Exception\ValidationException;
use Noval\UKK\Paket1\Model\Petugas;
use Noval\UKK\Paket1\Model\Spp;

class PetugasService {

	public function __construct(private PetugasRepository $petugasRepository)
	{
	}

	public function getAll(string $keyword = ''): ?array
	{
		return $this->petugasRepository->getAll($keyword);
	}

	public function simpanData(Petugas $petugas): ?Petugas
	{
		
		$this->validate($petugas);

		$this->validate($petugas);

		$isUsernameExist = !is_null($this->petugasRepository->findByUsername($petugas->username));

		if ($isUsernameExist) {
			throw new ValidationException("username sudah ada!", 1);
		}

		return $this->petugasRepository->save($petugas);
	}

	public function edit(Petugas $petugas,int $oldId): ?Petugas
	{
		
		$this->validate($petugas);

		$resultPetugas = $this->petugasRepository->findByUsername($petugas->username);
		$isUsernameExist = !is_null($resultPetugas);

		if ($isUsernameExist AND $petugas->username !=  $resultPetugas->username) {
			throw new ValidationException("username sudah ada!", 1);
		}

		return $this->petugasRepository->update($petugas, $oldId);
	}

	public function caripetugas(int $id): ?Petugas
	{
		return $this->petugasRepository->findById($id);
	}

	public function validate(Petugas $petugas)
	{
		if ($petugas->username == null OR trim($petugas->username) == '') {
			throw new ValidationException("username tidak boleh kosong!");
		}

		if ($petugas->password == null OR trim($petugas->password) == '') {
			throw new ValidationException("password tidak boleh kosong!");
		}

		if ($petugas->namaLengkap == null OR trim($petugas->namaLengkap) == '') {
			throw new ValidationException("nama Lengkap tidak boleh kosong!");
		}

		if ($petugas->level == null OR trim($petugas->level) == '') {
			throw new ValidationException("level tidak boleh kosong!");
		}
	}

	public function delete(int $id)
	{
		return $this->petugasRepository->delete($id);
	}

	public function validateLogin(string $username, string $password)
	{
		if ($username == null OR trim($username) == '') {
			throw new ValidationException("username tidak boleh kosong!");
		}

		if ($password == null OR trim($password) == '') {
			throw new ValidationException("password tidak boleh kosong!");
		}
	}

	public function login(string $username, string $password)
	{
		$this->validateLogin($username, $password);

		$petugas = $this->petugasRepository->findByUsername($username);
		// var_dump($petugas);
		if ($petugas == null) {
			throw new ValidationException("username atau password salah");
		}
	
		if ($petugas->password != $password) {
			throw new ValidationException("username atau password salah");
		}

		return $petugas;
	}
}

 ?>