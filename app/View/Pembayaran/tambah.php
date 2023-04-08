<div class="header item-center">
	<h1>TAMBAH PEMBAYARAN</h1>
</div>
<div class="form-container">
	<form action="" method="post">
		<?php if (isset($models['error'])) { ?>
			<span class="form-container__validation"><?php echo $models['error']; ?></span>
		<?php } ?>
		<label class="form-container__label" for="nisn">NISN</label>
		<input class="form-container__input" type="text" name="nisn" value="<?php echo $models['nisn'] ?? '' ?>" readonly>
		<label class="form-container__label" for="tglBayar">Tgl Bayar</label>
		<input class="form-container__input" type="date" name="tglBayar" value="<?php echo date("Y-m-d") ?>">
		<label class="form-container__label" for="bulanDibayar">Bulan</label>
		<select class="form-container__select" name="bulanDibayar" id="bulanDibayar" required>
			<option value="Januari">Januari</option>
			<option value="Februari">Februari</option>
			<option value="Maret">Maret</option>
			<option value="April">April</option>
			<option value="Mei">Mei</option>
			<option value="Juni">Juni</option>
			<option value="Juli">Juli</option>
			<option value="Agustus">Agustus</option>
			<option value="September">September</option>
			<option value="Oktober">Oktober</option>
			<option value="November">November</option>
			<option value="Desember">Desember</option>
		</select>
		<label class="form-container__label" for="tahunDibayar">Tahun</label>
		<input  class="form-container__input" type="number" name="tahunDibayar" value="<?php echo $models['tahunDibayar'] ?? date("Y") ?>">
		
		<!-- spp -->
		<label class="form-container__label" for="idSpp">ID SPP</label>
		<input readonly class="form-container__input" type="text" name="idSpp" value="<?php echo $models['spp']->id ?? '' ?>">
		<label  class="form-container__label" for="jumlahBayar">Jumlah Bayar</label>
		<input readonly class="form-container__input" type="text" name="jumlahBayar" value="<?php echo $models['spp']->nominal ?? '' ?>">
		
		<div class="form-contaner__button-container">
			<a class="form-container__button-secondary" href="/pembayaran">kembali</a>
			<input class="form-container__button" type="submit" name="tambah" value="tambah">
		</div>
	</form>
</div>