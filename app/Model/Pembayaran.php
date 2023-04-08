<?php 

namespace Noval\UKK\Paket1\Model;

class Pembayaran {

	public int $id;
	public int $idPetugas;
	public string $nisn;
	public string $tglBayar;
	public string $bulanDibayar;
	public int $tahunDibayar;
	public int $idSpp;
	public int $jumlahBayar;
}

 ?>