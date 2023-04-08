<div class="header item-center">
	<h1>TAMBAH PETUGAS</h1>
</div>
<div class="form-container">
	<form action="" method="post">
		<?php if (isset($models['error'])) { ?>
			<span class="form-container__validation"><?php echo $models['error']; ?></span>
		<?php } ?>
		<label class="form-container__label" for="username">Username</label>
		<input class="form-container__input" type="text" name="username" value="<?php echo $models['username'] ?? '' ?>">
		<label class="form-container__label" for="password">Password</label>
		<input class="form-container__input" type="text" name="password" value="<?php echo $models['password'] ?? '' ?>">
		<label class="form-container__label" for="namaLengkap">Nama Lengkap</label>
		<input class="form-container__input" type="text" name="namaLengkap" value="<?php echo $models['namaLengkap'] ?? '' ?>">
		<label class="form-container__label" for="level">Level</label>
		<select class="form-container__select" name="level" required>
			<option value="<?php echo $models['level'] ?? '' ?>"><?php echo $models['level'] ?? 'Pilih Petugas' ?></option>
			<option value="admin">Admin</option>
			<option value="petugas">Petugas</option>
		</select>
		<div class="form-contaner__button-container">
			<a class="form-container__button-secondary" href="/petugas">kembali</a>
			<input class="form-container__button" type="submit" name="tambah" value="tambah">
		</div>
	</form>
</div>