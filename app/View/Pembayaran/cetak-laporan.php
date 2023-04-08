<?php 
// header("Content-type: application/vnd-msExcel");
// header("Content-disposition: attachment;filename=dfkjsdfld.xlsx")

 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="http://localhost:8080/asset/css/css/cetak">
</head>
<body>
	<div>
	<h1>LAPORAN PEMBAYARAN</h1>
</div>
	<table border="1">
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
		</thead>
		<tbody>
			<?php 
			if (isset($models['data'])) {
				foreach ($models['data'] as $data) {?>
					<tr >
						<td ><?php echo $data->id ?></td>
						<td ><?php echo $data->idPetugas ?></td>
						<td ><?php echo $data->namaPetugas ?></td>
						<td ><?php echo $data->nisn ?></td>
						<td ><?php echo $data->namaPetugas ?></td>
						<td ><?php echo $data->tglBayar ?></td>
						<td ><?php echo $data->bulanDibayar ?></td>
						<td ><?php echo $data->tahunDibayar ?></td>
						<td ><?php echo $data->nominal ?></td>
					</tr>
				<?php }

			} ?>
		</tbody>
	</table>
</div>
<script type="text/javascript">window.print()</script>
</body>
</html>