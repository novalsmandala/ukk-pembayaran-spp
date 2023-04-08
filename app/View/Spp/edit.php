<div class="header item-center">
	<h1>EDIT SPP</h1>
</div>
<div class="form-container">
	<form action="" method="post">
		<?php if (isset($models['error'])) { ?>
			<span class="form-container__validation"><?php echo $models['error']; ?></span>
		<?php } ?>
		<label class="form-container__label" for="tahun">Tahun SPP</label>
		<input class="form-container__input" type="text" name="tahun" value="<?php echo $models['tahun'] ?>">
		<label class="form-container__label" for="nominal">Nominal</label>
		<input class="form-container__input" type="number" name="nominal" value="<?php echo $models['nominal'] ?>">
		<div class="form-contaner__button-container">
			<a class="form-container__button-secondary" href="/spp">kembali</a>
			<input class="form-container__button" type="submit" name="tambah" value="ubah">
		</div>
	</form>
</div>