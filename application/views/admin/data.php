<div class="row">
<!-- Column -->
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Data Generate QR</h4>
                <h6 class="card-subtitle"></h6>
                <a href="<?=base_url();?>admin/input"><button type="button" class="btn btn-info btn-rounded m-t-10 mb-2 float-right">Input Data Baru</button></a>
				<div class="row">
					<div class="col-sm-12 col-lg-3">
						<form>
	                        <div class="input-group mb-3">
	                            <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
	                            <div class="input-group-append">
	                                <button class="btn btn-success" type="button"><i class="ti-search"></i></button>
	                            </div>
	                        </div>
	                    </form>
	                </div>
			    </div>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Pemilik</th>
								<th>No Polisi</th>
								<th>Kuota BBM</th>
								<th>Jenis Kendaraan</th>
								<th>No Brizzi</th>
								<th>Dokumen</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 1;
							if (!empty($dataqrs)): ?>
							<?php foreach($dataqrs as $data) : 
							?>
							<tr>
								<td><?=$no?></td>
								<td><?=$data->nama_pemilik?></td>
								<td><?=$data->no_pol?></td>
								<td><?=$data->kuota_bbm?></td>
								<td><?=$data->jenis_kendaraan?></td>
								<td><?=$data->no_kartu?></td>
								<td><?=$data->dokumen?></td>
								<td><?=$data->status_approve?></td>
								<td></td>
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
				</div>
				<div class="row">
			        <div class="col">
			            <!--Tampilkan pagination-->
			            <?php echo $pagination; ?>
			        </div>
			    </div>
			</div>
		</div>
	</div>
	<!-- Column -->
</div>