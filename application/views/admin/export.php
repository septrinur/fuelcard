
<h4 class="card-title">Data Verifikasi QR</h4>
<table border="1">
	<thead>
		<tr style="background-color: #e9ecef">
			<th>No</th>
			<th>Nama SPBU</th>
			<th>Nama Petugas</th>
			<th>No BRIZZI</th>
			<th>No Pol</th>
			<th>Foto</th>
			<th>Kuota</th>
			<th>Tgl Transaksi</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no = 1;
		if (!empty($spbu)): ?>
		<?php foreach($spbu as $data) : 
			$base64 = $this->encryption->encrypt($data->id_spbu);
			$urisafe = strtr($base64, '+/=', '.-~');
		?>
		<tr>
			<td><?=$no?></td>
			<td><?=$data->nama_spbu?></td>
			<td><?=$data->name?></td>
			<td><?=$data->kartu?></td>
			<td><?=$data->nopol?></td>
			<td>
				<?php if ($data->image==null || empty($data->image)) {  ?>
					-
				<?php }else{ ?>
					<?=base_url().$data->image?>
				<?php } ?>
			</td>
			<td><?=get_kuota($data->nopol,$data->kartu)?></td>
			<td><?=tanggal_indo($data->trxdate)?></td>
			<td>
				<?php if ($data->stat == 1) { ?>
					<label class="label label-success">Berhasil</label>
				<?php }else{ ?>
					<label class="label label-danger">Gagal</label>
				<?php } ?>
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
				<td style="display: none;"></td>
			</tr>
		<?php endif ?>
	</tbody>
</table>