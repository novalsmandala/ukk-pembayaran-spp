<div class="header item-center">
	<h1>TAMBAH SISWA</h1>
</div>
<div class="form-container">
	<form action="" method="post">
		<?php if (isset($models['error'])) { ?>
			<span class="form-container__validation"><?php echo $models['error']; ?></span>
		<?php } ?>
		<label class="form-container__label" for="nisn">nisn</label>
		<input class="form-container__input" type="text" name="nisn" value="<?php echo $models['nisn'] ?? '' ?>">
		<label class="form-container__label" for="nis">nis</label>
		<input class="form-container__input" type="text" name="nis" value="<?php echo $models['nis'] ?? '' ?>">
		<label class="form-container__label" for="nama">Nama Lengkap</label>
		<input class="form-container__input" type="text" name="nama" value="<?php echo $models['nama'] ?? '' ?>">
		<label class="form-container__label" for="kelas">kelas</label>
		<select class="form-container__select" name="idKelas" required>
			<option value="<?php echo $models['idKelas'] ?? '' ?>"><?php echo ($models['idKelas'] == '')? 'Pilih Kelas' : $models['idKelas'] ?></option>
			<?php foreach ($models['dataKelas'] as $kelas) { ?>
				<option value="<?= $kelas->id ?>"><?= $kelas->nama . " - " . $kelas->kompetensiKeahlian ?></option>
			<?php } ?>
		</select>
		<label class="form-container__label" for="alamat">alamat</label>
		<input class="form-container__input" type="text" name="alamat" value="<?php echo $models['alamat'] ?? '' ?>">
		<label class="form-container__label" for="noTelp">No. Telp</label>
		<input class="form-container__input" type="text" name="noTelp" value="<?php echo $models['noTelp'] ?? '' ?>">
		<label class="form-container__label" for="idSpp">SPP</label>
		<select class="form-container__select" name="idSpp" required>
			<?php $models['idSpp']; ?>
			<option value="<?php echo $models['idSpp'] ?? '' ?>"><?php echo ($models['idSpp'] == '')? 'Pilih Spp' : $models['idSpp'] ?></option>
			<?php foreach ($models['dataSpp'] as $spp) { ?>
				<option value="<?= $spp->id ?>"><?= $spp->tahun . " - " . $spp->nominal ?></option>
			<?php } ?>
		</select>
		<div class="form-contaner__button-container">
			<a class="form-container__button-secondary" href="/siswa">kembali</a>
			<input class="form-container__button" type="submit" name="tambah" value="ubah">
		</div>
	</form>
</div>