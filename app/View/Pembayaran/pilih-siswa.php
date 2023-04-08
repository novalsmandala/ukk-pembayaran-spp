<div class="header item-center">
	<h1>PILIH SISWA</h1>
</div>
<div class="table-container">
	<div class="table-container__nav">
		<!-- <a class="cta-button" href="pembayaran/tambah">Tambah</a> -->
		<form action="">
			<input class="search" type="text" name="search" placeholder="search" value="<?php echo $_GET['search'] ?? '' ?>">
		</form>
	</div>
	<div class="main-table">
	<table>
			<thead class="h-4">
				<!-- <th>No</th> -->
				<th>NISN</th>
				<th>NIS</th>
				<th>Nama</th>
				<th>Kelas</th>
				<th>Alamat</th>
				<th>No. Telp</th>
				<th>SPP</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php 
				if (isset($models['dataSiswa'])) {
					foreach ($models['dataSiswa'] as $data) {?>
						<tr class="h-5 table-row bg-grey-hover" onclick="choose('<?php echo $data->nisn ?>')">
							<td class="w-6 p-2 text-center"><?php echo $data->nisn ?></td>
							<td class="w-4 p-2 text-center"><?php echo $data->nis ?></td>
							<td class="mw-6 p-2 text-center"><?php echo $data->nama ?></td>
							<td class="w-6 p-2 text-center"><?php echo $data->idKelas ?></td>
							<td class="mw-6 p-2 text-center"><?php echo $data->alamat ?></td>
							<td class="w-6 p-2 text-center"><?php echo $data->noTelp ?></td>
							<td class="w-6 p-2 text-center"><?php echo $data->idSpp ?></td>
							<td class="w-6 p-2 text-center">
								<a class="btn bg-light-green" href="pembayaran/tambah/<?php echo $data->nisn ?>">pilih</a>
							</td>
						</tr>
					<?php }

				} ?>
			</tbody>
		</table>
	</div>
</div>
<script>
	function choose(id) {
		window.location = `pembayaran/tambah/${id}`;
	}
</script>