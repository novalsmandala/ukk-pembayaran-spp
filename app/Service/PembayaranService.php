<?php 

namespace Noval\UKK\Paket1\Service;

use Noval\UKK\Paket1\Repository\PembayaranRepository;
use Noval\UKK\Paket1\Exception\ValidationException;
use Noval\UKK\Paket1\Model\Siswa;
use Noval\UKK\Paket1\Model\Kelas;
use Noval\UKK\Paket1\Model\Spp;
use Noval\UKK\Paket1\Model\Pembayaran;
use Noval\UKK\Paket1\Model\History;

class PembayaranService {

	public function __construct(private PembayaranRepository $pembayaranRepository)
	{
	}

	public function getAll(string $keyword = ''): ?array
	{
		return $this->pembayaranRepository->getAll($keyword);
	}

	public function getAllByRange(string $from, string $to): ?array
	{
		return $this->pembayaranRepository->findByRangeDate($from, $to);
	}

	public function simpanData(Pembayaran $pembayaran): ?Pembayaran
	{
		
		$this->validate($pembayaran);
		return $this->pembayaranRepository->save($pembayaran);
	}
	public function validate(Pembayaran $pembayaran)
	{
		if ($pembayaran->idPetugas == null OR trim($pembayaran->idPetugas) == '') {
			throw new ValidationException("id Petugas tidak boleh kosong!");
		}

		if ($pembayaran->nisn == null OR trim($pembayaran->nisn) == '') {
			throw new ValidationException("nisn tidak boleh kosong!");
		}

		if ($pembayaran->tglBayar == null OR trim($pembayaran->tglBayar) == '') {
			throw new ValidationException("tglBayar tidak boleh kosong!");
		}

		if ($pembayaran->bulanDibayar == null OR trim($pembayaran->bulanDibayar) == '') {
			throw new ValidationException("bulan tidak boleh kosong!");
		}

		if ($pembayaran->tahunDibayar == null OR trim($pembayaran->tahunDibayar) == '') {
			throw new ValidationException("tahun tidak boleh kosong!");
		}

		if ($pembayaran->idSpp == null OR trim($pembayaran->idSpp) == '') {
			throw new ValidationException("SPP tidak boleh kosong!");
		}

		if ($pembayaran->jumlahBayar == null OR trim($pembayaran->jumlahBayar) == '') {
			throw new ValidationException("jumlah bayar tidak boleh kosong!");
		}
	}

	


	public function cariPembayaran(int $id): ?History
	{
		return $this->pembayaranRepository->findById($id);
	}

	public function cariPembayaranByNisn(string $nisn): ?array
	{
		return $this->pembayaranRepository->findByNisn($nisn);
	}
}

 ?>