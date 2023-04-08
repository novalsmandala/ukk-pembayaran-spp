<div class="header item-center">
	<h1>DATA KELAS</h1>
</div>
<div class="table-container">
	<div class="table-container__nav">
		<a class="cta-button" href="kelas/tambah">Tambah</a>
		<form action="">
			<input class="search" type="text" name="search" placeholder="search" value="<?php echo $_GET['search'] ?? '' ?>">
	</div>
	<div class="main-table">
		<table>
			<thead class="h-4">
				<!-- <th>No</th> -->
				<th>Nama Kelas</th>
				<th>Kompetensi Keahlian</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php 
				if (isset($models['dataKelas'])) {
					foreach ($models['dataKelas'] as $data) {?>
						<tr class="h-5 table-row">
							<td class="w-6 p-2 text-center"><?php echo $data->nama ?></td>
							<td class="w-6 p-2 text-center"><?php echo $data->kompetensiKeahlian ?></td>
							<td class="w-6 p-2 text-center">
								<a class="btn bg-light-green" href="kelas/edit/<?php echo $data->id ?>">edit</a>
								<a class="btn bg-red-danger" href="kelas/hapus/<?php echo $data->id ?>" onclick="confirm('anda yakin untuk menghapus?')">hapus</a>
							</td>
						</tr>
					<?php } } ?>
			</tbody>
		</table>
	</div>
</div>