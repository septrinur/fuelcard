
<?php if (isset($periode)) {
	$period= 'Periode Bulan '.bulan($periode);
}else{
	$period = '';
} ?>
<h4 class="card-title">Data Verifikasi QR <?=$period?></h4>
<table border="1">
	<thead>
		<tr style="background-color: #e9ecef">
			<th>No</th>
			<th>Nama SPBU</th>
			<th>Berhasil Scan</th>
			<th>Gagal Scan</th>
			<th>Total Scan</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no = 1;
		if (!empty($spbu)): ?>
		<?php foreach($spbu as $data) : 
		?>
		<tr>
			<td><?=$no?></td>
			<td><?=$data->nama_spbu?></td>
			<td><?=$data->success_scan?></td>
			<td><?=$data->failed_scan?></td>
			<td><?=$data->total_scan?></td>
		</tr>
		<?php 
		$no++;
		endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="7" style="text-align:center;">Belum Ada Data</td>
				<td style="display: none;"></td>
				<td style="display: none;"></td>
				<td style="display: none;"></td>
				<td style="display: none;"></td>
			</tr>
		<?php endif ?>
	</tbody>
</table>