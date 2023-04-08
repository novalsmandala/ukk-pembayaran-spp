<?php 

namespace Noval\UKK\Paket1\Service;

use Noval\UKK\Paket1\Repository\SppRepository;
use Noval\UKK\Paket1\Exception\ValidationException;
use Noval\UKK\Paket1\Model\Spp;

class SppService {

	public function __construct(private SppRepository $sppRepository)
	{
	}

	public function getAll(string $keyword = ''): ?array
	{
		return $this->sppRepository->getAll($keyword);
	}

	public function simpanData(Spp $spp): ?Spp
	{
		
		$this->validate($spp);

		return $this->sppRepository->save($spp);
	}

	public function edit(Spp $spp,int $oldId): ?Spp
	{
		
		$this->validate($spp);

		return $this->sppRepository->update($spp, $oldId);
	}

	public function cariSpp(int $id): ?Spp
	{
		return $this->sppRepository->findById($id);
	}

	public function validate(Spp $spp)
	{
		if ($spp->tahun == null OR trim($spp->tahun) == '') {
			throw new ValidationException("tahun tidak boleh kosong!");
		}

		if ($spp->nominal == null OR trim($spp->nominal) == '') {
			throw new ValidationException("nominal tidak boleh kosong!");
		}
	}

	public function delete(int $id)
	{
		return $this->sppRepository->delete($id);
	}
}

 ?>