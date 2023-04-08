<?php 

namespace Noval\UKK\Paket1\Service;

use Noval\UKK\Paket1\Repository\SiswaRepository;
use Noval\UKK\Paket1\Exception\ValidationException;
use Noval\UKK\Paket1\Model\Siswa;
use Noval\UKK\Paket1\Model\Kelas;
use Noval\UKK\Paket1\Model\Spp;

class SiswaService {

	public function __construct(private SiswaRepository $siswaRepository)
	{
	}

	public function getAll(string $keyword = ''): ?array
	{
		return $this->siswaRepository->getAll($keyword);
	}

	public function simpanData(Siswa $siswa): ?Siswa
	{
		
		$this->validate($siswa);

		$isNisnExist = !is_null($this->siswaRepository->findByNisn($siswa->nisn));
		$isNisExist = !is_null($this->siswaRepository->findByNis($siswa->nis));

		if ($isNisnExist) {
			throw new ValidationException("nisn sudah ada!", 1);
		}

		if ($isNisExist) {
			throw new ValidationException("nis sudah ada!", 1);
		}

		return $this->siswaRepository->save($siswa);
	}

	public function edit(Siswa $siswa,string $oldNisn): ?Siswa
	{
		
		$this->validate($siswa);

		$resultByNisn = $this->siswaRepository->findByNisn($siswa->nisn);
		$isNisnExist = !is_null($resultByNisn);
		$resultByNis = $this->siswaRepository->findByNis($siswa->nis);
		$isNisExist = !is_null($resultByNis);

		if ($siswa->nisn == $oldNisn AND $siswa->nis == $resultByNisn->nis) {
			// echo "wala";
			// var_dump($siswa);
			return $this->siswaRepository->update($siswa, $oldNisn);
		}

		if ($isNisnExist) {
			throw new ValidationException("nisn sudah ada!", 1);
			}

		if ($isNisExist) {
			throw new ValidationException("nis sudah ada!", 1);
		}

		return $this->siswaRepository->update($siswa, $oldNisn);
	}

	public function validate(Siswa $siswa)
	{
		if ($siswa->nisn == null OR trim($siswa->nisn) == '') {
			throw new ValidationException("nisn tidak boleh kosong!");
		}

		if ($siswa->nis == null OR trim($siswa->nis) == '') {
			throw new ValidationException("nis tidak boleh kosong!");
		}

		if ($siswa->nama == null OR trim($siswa->nama) == '') {
			throw new ValidationException("nama tidak boleh kosong!");
		}

		if ($siswa->idKelas == null OR trim($siswa->idKelas) == '') {
			throw new ValidationException("kelas tidak boleh kosong!");
		}

		if ($siswa->alamat == null OR trim($siswa->alamat) == '') {
			throw new ValidationException("alamat tidak boleh kosong!");
		}

		if ($siswa->noTelp == null OR trim($siswa->noTelp) == '') {
			throw new ValidationException("no telp tidak boleh kosong!");
		}

		if ($siswa->idSpp == null OR trim($siswa->idSpp) == '') {
			throw new ValidationException("Spp tidak boleh kosong!");
		}
	}

	public function delete(string $nisn)
	{
		return $this->siswaRepository->delete($nisn);
	}

	public function cariSiswa(string $nisn): ?Siswa
	{
		return $this->siswaRepository->findByNisn($nisn);
	}

	public function validateLogin(string $nis, string $nama)
	{
		if ($nis == null OR trim($nis) == '') {
			throw new ValidationException("nis tidak boleh kosong!");
		}

		if ($nama == null OR trim($nama) == '') {
			throw new ValidationException("nama tidak boleh kosong!");
		}
	}

	public function login(string $nis, string $nama)
	{
		$this->validateLogin($nis, $nama);

		$siswa = $this->siswaRepository->findByNis($nis);
		// var_dump($siswa);
		if ($siswa == null) {
			throw new ValidationException("nis atau nama salah");
			return;
		}
		

		if (strtoupper($siswa->nama) != strtoupper($nama)) {
			throw new ValidationException("nis atau nama salah");
			return;
		}

		return $siswa;
	}
}

 ?>