<div class="row">
<!-- Column -->
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Data Generate QR</h4>
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
								$base64 = $this->encryption->encrypt($data->id_qr);
								$urisafe = strtr($base64, '+/=', '.-~');
							?>
							<tr>
								<td><?=$no?></td>
								<td><?=$data->nama_pemilik?></td>
								<td><?=$data->no_pol?></td>
								<td><?=$data->kuota_bbm?></td>
								<td><?=$data->jenis_kendaraan?></td>
								<td><?=$data->no_kartu?></td>
								<td><?=$data->dokumen?></td>
								<td>
									<?php if ($data->status_approve == 1) { ?>
										<label class="label label-success">Approved</label>
									<?php }else{ ?>
										<label class="label label-danger">Menunggu Approval</label>
									<?php } ?>
								</td>
								<td>
									<a class="btn btn-success" href="<?=base_url('admin/approve/'.$urisafe);?>" onclick="return confirm('Apakah Anda yakin approve data ini?')">
											<i class="ti-check-box"></i> 
											Approve
										</a>
								</td>
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