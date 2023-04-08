<!DOCTYPE html>
<html>
<head>
	<title>Login Siswa</title>
	<link rel="stylesheet" type="text/css" href="http://localhost:8080/asset/css/css/login">
</head>
<body>
	<div class="login-container reverse">
		<div class="info-container">
			<h1>SELAMAT DATANG DI APLIKASI PEMBAYARAN SPP</h1>
			<a class="cta-button" href="/login">Login Siswa</a>
		</div>
		<div class="form-container">
			<h1>LOGIN PETUGAS</h1>
			<form action="" method="post">
				<?php if (isset($models['error'])) { ?>
					<span class="form-container__validation"><?php echo $models['error']; ?></span>
				<?php } ?>
				<label class="form-container__label" for="username">Username</label>
				<input class="form-container__input" type="text" name="username" value="<?php echo $models['username'] ?? '' ?>">
				<label class="form-container__label" for="password">Password</label>
				<input class="form-container__input" type="password" name="password" value="<?php echo $models['password'] ?? '' ?>">
				<div class="form-contaner__button-container">
					<!-- <a class="form-container__button-secondary" href="/kelas">kembali</a> -->
					<input class="form-container__button" type="submit" name="tambah" value="login">
				</div>
			</form>
		</div>
	</div>
</body>
</html>