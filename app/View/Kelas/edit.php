<div class="header item-center">
	<h1>EDIT KELAS</h1>
</div>
<div class="form-container">
	<form action="" method="post">
		<?php if (isset($models['error'])) { ?>
			<span class="form-container__validation"><?php echo $models['error']; ?></span>
		<?php } ?>
		<label class="form-container__label" for="nama">Nama Kelas</label>
		<input class="form-container__input" type="text" name="nama" value="<?php echo $models['nama'] ?>">
		<label class="form-container__label" for="kompetensiKeahlian">Kompetensi Keahlian</label>
		<input class="form-container__input" type="text" name="kompetensiKeahlian" value="<?php echo $models['kompetensiKeahlian'] ?>">
		<div class="form-contaner__button-container">
			<a class="form-container__button-secondary" href="/kelas">kembali</a>
			<input class="form-container__button" type="submit" name="tambah" value="ubah">
		</div>
	</form>
</div>