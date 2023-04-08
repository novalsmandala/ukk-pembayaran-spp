<div class="header item-center">
	<h1>DATA SPP</h1>
</div>
<div class="table-container">
	<div class="table-container__nav">
		<a class="cta-button" href="spp/tambah">Tambah</a>
		<form action="">
			<input class="search" type="text" name="search" placeholder="search" value="<?php echo $_GET['search'] ?? '' ?>">
	</div>
	<div class="main-table">
	<table>
			<thead class="h-4">
				<!-- <th>No</th> -->
				<th>Tahun</th>
				<th>Nominal</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php 
				if (isset($models['dataSpp'])) {
					foreach ($models['dataSpp'] as $data) {?>
						<tr class="h-5 table-row">
							<td class="w-6 p-2 text-center"><?php echo $data->tahun ?></td>
							<td class="w-6 p-2 text-center"><?php echo "Rp " . number_format($data->nominal) ?></td>
							<td class="w-6 p-2 text-center action">
								<a class="btn bg-light-green" href="spp/edit/<?php echo $data->id ?>">edit</a>
								<a class="btn bg-red-danger" href="spp/hapus/<?php echo $data->id ?>">hapus</a>
							</td>
						</tr>
					<?php }

				} ?>
			</tbody>
		</table>
	</div>
</div>