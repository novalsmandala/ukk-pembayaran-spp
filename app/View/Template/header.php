<!DOCTYPE html>
<html>
<head>
	<title>Pembayaran SPP</title>
	<link rel="stylesheet" type="text/css" href="/asset/css/css/style">
</head>
<body>
	<div class="grid-container">
		<aside>
			<h3>Pembayaran SPP</h3>
			<div class="active" id="burger">🍔</div>
			<ul>
				<!-- <li><a href="/dashboard">📉<span>dashboards</span></a></li> -->
				<li id="home"><a href="/home"><div class="aside-item">🏠<span>home</span></div></a></li>
				<li id="history"><a href="/history"><div class="aside-item">⏳<span>history</span></div></a></li>
				<?php if ($_SESSION['role'] != 'siswa') {?>
					<li id="pembayaran"><a href="/pembayaran"><div class="aside-item">💲<span>pembayaran</span></div></a></li>
				<?php } ?>
				<?php if ($_SESSION['role'] == 'admin') {?>
					<li id="siswa"><a href="/siswa"><div class="aside-item">👨‍🎓<span>siswa</span></div></a></li>
					<li id="kelas"><a href="/kelas"><div class="aside-item">📚<span>kelas</span></div></a></li>
					<li id="spp"><a href="/spp"><div class="aside-item">💳<span>spp</span></div></a></li>
					<li id="petugas"><a href="/petugas"><div class="aside-item">👨‍💼<span>petugas</span></div></a></li>
					<li id="laporan"><a href="/laporan"><div class="aside-item">📜<span>laporan</span></div></a></li>
				<?php } ?>
			</ul>
			<a href="logout" class="logout-nav">🚪logout</a>
		</aside>
		<h3 id="burger">🍔</h3>
		<nav>
			<h3>
				<?php echo strtoupper($curentPath) ?></h3>
			<h3><?php echo $username ?></h3>
		</nav>
		<main>
			<script>
				const item = document.getElementById("<?php echo strtolower($curentPath) ?>");
				item.classList.add("active");

			</script>