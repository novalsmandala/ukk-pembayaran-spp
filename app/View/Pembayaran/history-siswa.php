<div class="header item-center">
	<h1>HISTORY PEMBAYARAN SISWA</h1>

</div>
<div class="table-container">
	<div class="table-container__nav">
	</div>
	<div class="main-table">
	<table>
			<thead class="h-4">
				<!-- <th>No</th> -->
				<th>ID Pembayaran</th>
				<th>ID Petugas</th>
				<th>Nama Petugas</th>
				<th>NISN</th>
				<th>Nama Siswa</th>
				<th>Tgl Bayar</th>
				<th>Bulan</th>
				<th>Tahun</th>
				<th>Nominal</th>
				<th class="action">Action</th>
			</thead>
			<tbody>
				<?php 
				if (isset($models['dataPembayaran'])) {
					foreach ($models['dataPembayaran'] as $data) {?>
						<tr class="h-5 table-row">
							<td class="w-6 p-2 text-center"><?php echo $data->id ?></td>
							<td class="w-4 p-2 text-center"><?php echo $data->idPetugas ?></td>
							<td class="w-6 p-2 text-center"><?php echo $data->namaPetugas ?></td>
							<td class="w-6 p-2 text-center"><?php echo $data->nisn ?></td>
							<td class="mw-6 p-2 text-center"><?php echo $models['dataSiswa']->nama ?></td>
							<td class="w-6 p-2 text-center"><?php echo $data->tglBayar ?></td>
							<td class="w-6 p-2 text-center"><?php echo $data->bulanDibayar ?></td>
							<td class="w-6 p-2 text-center"><?php echo $data->tahunDibayar ?></td>
							<td class="w-6 p-2 text-center"><?php echo "Rp " . number_format($data->nominal) ?></td>
							<td class="w-action p-2 text-center">
								<a class="btn bg-light-green" href="pembayaran/cetak/<?php echo $data->id ?>">cetak</a>
							</td>
						</tr>
					<?php }

				} ?>
			</tbody>
		</table>
	</div>
</div>