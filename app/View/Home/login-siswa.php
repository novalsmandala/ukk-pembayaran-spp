<!DOCTYPE html>
<html>
<head>
	<title>Login Siswa</title>
	<link rel="stylesheet" type="text/css" href="http://localhost:8080/asset/css/css/login">
</head>
<body>
	<div class="login-container">
		<div class="info-container">
			<h1 style="">SELAMAT DATANG DI APLIKASI PEMBAYARAN SPP</h1>
			<a class="cta-button" href="/login/petugas">Login Petugas</a>
		</div>
		<div class="form-container">
			<h1>LOGIN SISWA</h1>
			<?php if (isset($models['error'])) { ?>
			<span class="form-container__validation"><?php echo $models['error']; ?></span>
			<?php } ?>
			<form action="" method="post">
				<label class="form-container__label" for="nis">NIS</label>
				<input class="form-container__input" type="text" name="nis" value="<?php echo $models['nis'] ?? '' ?>">
				<label class="form-container__label" for="nama">Nama Lengkap</label>
				<input class="form-container__input" type="text" name="nama" value="<?php echo $models['nama'] ?? '' ?>">
				<div class="form-contaner__button-container">
					<!-- <a class="form-container__button-secondary" href="/kelas">kembali</a> -->
					<input class="form-container__button" type="submit" name="tambah" value="login">
				</div>
			</form>
		</div>
	</div>
</body>
</html>