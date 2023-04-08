<!DOCTYPE html>
<html>
<head>
	<title>Kuwitansi</title>
	<style type="text/css">
		.bukti-container {
			display: flex;
			flex-direction: column;
			margin: 10vh auto;
			width: 30vw;
			/*padding: 0 20vw;*/
			border: 1px solid black;
			padding: 1em;
			padding-bottom: 2.5em;
		}

		.bukti-container h1 {
			text-align: center;
		}

		.bukti-container span {
			margin-top: 1em
		}
		span.line {
			margin-top: .1em;
			border-top: 1px solid black;
		}
		span.mt-1 {
			margin-top: 1.2em
		}

		@media print {
			.bukti-container {
				width: 70%;
			}
		}
	</style>
</head>
<body>
	<div class="bukti-container">
		<h1>BUKTI PEMBAYARAN SPP</h1>
		<span class="line"></span>
		<span class="line"></span>
		<span>ID Pembayaran : <?php echo $models['dataPembayaran']->id ?></span>
		<span>Petugas : <?php echo $models['dataPembayaran']->namaPetugas ?></span>
		<span>NISN : <?php echo $models['dataPembayaran']->nisn ?></span>
		<span>Tanggal Bayar : <?php echo $models['dataPembayaran']->tglBayar ?></span>
		<span>Bulan Bayar : <?php echo $models['dataPembayaran']->bulanDibayar ?></span>
		<span>Tahun Bayar : <?php echo $models['dataPembayaran']->tahunDibayar ?></span>
		<span>Nominal : <?php echo "Rp " . number_format($models['dataPembayaran']->nominal) ?></span>
		<span>Jumlah Bayar : <?php echo "Rp " . number_format($models['dataPembayaran']->jumlahBayar) ?></span>
</div>
<script type="text/javascript">
	window.print();
</script>
</body>
</html>