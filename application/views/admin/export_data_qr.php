
<h4 class="card-title">Data QR Disetujui</h4>
<table border="1">
	<thead>
		<tr style="background-color: #e9ecef">
			<th>Kode</th>
			<th>Nama Pemilik</th>
			<th>Nama Perusahaan</th>
			<th>No Polisi</th>
			<th>Kuota BBM</th>
			<th>Jenis Kendaraan</th>
			<th>No Brizzi</th>
			<th>Tanggal Disetujui</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no = 1;
		if (!empty($dataqrs)): ?>
		<?php foreach($dataqrs as $data) : 
		?>
		<tr>
			<td><?=$data->code?></td>
			<td><?=$data->nama_pemilik?></td>
			<td><?=$data->nama_perusahaan?></td>
			<td><?=$data->no_pol?></td>
			<td><?=$data->kuota_bbm?></td>
			<td><?=$data->jenis_kendaraan?></td>
			<td style="mso-number-format:\@;"><?=$data->no_kartu?></td>
			<td style="mso-number-format:\@;"><?=tanggal_indo($data->date_approved)?></td>
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
				<td style="display: none;"></td>
			</tr>
		<?php endif ?>
	</tbody>
</table>