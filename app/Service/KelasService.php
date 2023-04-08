<?php 

namespace Noval\UKK\Paket1\Service;

use Noval\UKK\Paket1\Repository\KelasRepository;
use Noval\UKK\Paket1\Exception\ValidationException;
use Noval\UKK\Paket1\Model\Kelas;

class KelasService {

	public function __construct(private KelasRepository $kelasRepository)
	{
	}

	public function getAll(string $keyword = ''): ?array
	{
		return $this->kelasRepository->getAll($keyword);
	}

	public function simpanData(Kelas $kelas): ?Kelas
	{
		
		$this->validate($kelas);

		return $this->kelasRepository->save($kelas);
	}

	public function edit(Kelas $kelas,int $oldId): ?Kelas
	{
		
		$this->validate($kelas);

		return $this->kelasRepository->update($kelas, $oldId);
	}

	public function cariKelas(int $id): ?Kelas
	{
		return $this->kelasRepository->findById($id);
	}

	public function validate(Kelas $kelas)
	{
		if ($kelas->nama == null OR trim($kelas->nama) == '') {
			throw new ValidationException("nama kelas tidak boleh kosong!");
		}

		if ($kelas->kompetensiKeahlian == null OR trim($kelas->kompetensiKeahlian) == '') {
			throw new ValidationException("kompetemsi keahlian tidak boleh kosong!");
		}
	}

	public function delete(int $id)
	{
		return $this->kelasRepository->delete($id);
	}
}

 ?>