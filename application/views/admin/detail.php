<div class="row">
<!-- Column -->
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Data Verifikasi QR</h4>
                <h6 class="card-subtitle"></h6>
                <center>
                	<?php if ($this->session->flashdata('data_success') != null) { ?>
                		<div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            <h3 class="text-success"><i class="fa fa-check-circle"></i> Berhasil</h3> 
                            <?php echo $this->session->flashdata('data_success'); ?>
                        </div>
                	<?php } ?>
                </center>
                <center>
                	<?php if ($this->session->flashdata('data_failed') != null) { ?>
                		<div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            <h3 class="text-danger"><i class="fa fa-exclamation-triangle"></i> Terjadi Kesalahan</h3> 
                            <?php echo $this->session->flashdata('data_failed'); ?>
                        </div>
                	<?php } ?>
                </center>
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
					<table class="table v-middle">
						<thead>
							<tr class="bg-light">
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
								<td><?=$data->image?></td>
								<td></td>
								<td><?=$data->trxdate?></td>
								<td><?=$data->stat?></td>
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