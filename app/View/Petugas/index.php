<div class="header item-center">
	<h1>DATA PETUGAS</h1>
</div>
<div class="table-container">
	<div class="table-container__nav">
		<a class="cta-button" href="petugas/tambah">Tambah</a>
		<form action="">
			<input class="search" type="text" name="search" placeholder="search" value="<?php echo $_GET['search'] ?? '' ?>">
	</div>
	<div class="main-table">
	<table>
			<thead class="h-4">
				<!-- <th>No</th> -->
				<th>Tahun</th>
				<th>Username</th>
				<th>Nama Petugas</th>
				<th>Level</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php 
				if (isset($models['dataPetugas'])) {
					foreach ($models['dataPetugas'] as $data) {?>
						<tr class="h-5 table-row">
							<td class="w-6 p-2 text-center"><?php echo $data->username ?></td>
							<td class="w-6 p-2 text-center"><?php echo $data->namaLengkap ?></td>
							<td class="w-6 p-2 text-center"><?php echo $data->password ?></td>
							<td class="w-6 p-2 text-center"><?php echo $data->level ?></td>
							<td class="w-6 p-2 text-center">
								<a class="btn bg-light-green" href="petugas/edit/<?php echo $data->id ?>">edit</a>
								<a class="btn bg-red-danger" href="petugas/hapus/<?php echo $data->id ?>">hapus</a>
							</td>
						</tr>
					<?php }

				} ?>
			</tbody>
		</table>
	</div>
</div>