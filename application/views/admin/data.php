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
						<?=form_open(site_url('admin/data'),array('method'=>'get'));?>
	                        <div class="input-group mb-3">
	                            <input type="text" name="s" class="form-control" placeholder="cari kode, nama, nopol, no brizzi" aria-label="" aria-describedby="basic-addon1" value="<?php echo (isset($s)) ? $s : ''; ?>">
	                            <div class="input-group-append">
	                                <button class="btn btn-success" type="submit"><i class="ti-search"></i></button>
	                            </div>
	                        </div>
	                    </form>
	                </div>
			    </div>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">Kode</th>
								<th scope="col">Nama Pemilik</th>
								<th scope="col">Nama Perusahaan</th>
								<th scope="col">No Polisi</th>
								<th scope="col">Kuota BBM</th>
								<th scope="col">Jenis Kendaraan</th>
								<th scope="col">No Brizzi</th>
								<th scope="col">Dokumen</th>
								<th scope="col">Status</th>
								<th scope="col">Aksi</th>
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
								<td><?=$data->code?></td>
								<td><?=$data->nama_pemilik?></td>
								<td><?=$data->nama_perusahaan?></td>
								<td><?=$data->no_pol?></td>
								<td><?=$data->kuota_bbm?></td>
								<td><?=$data->jenis_kendaraan?></td>
								<td><?=$data->no_kartu?></td>
								<td><?php
									if (!empty($data->dokumen) || $data->dokumen != null) { ?>
										<a href="<?=base_url('uploads/data/').$data->dokumen?>" target="_blank"><?=$data->dokumen?></a>
									<?php }else{?>	
										-
									<?php }?>	
								</td>
								<td>
									<?php if ($data->status_approve == 1) { ?>
										<label class="label label-success">Approved</label>
									<?php }elseif ($data->status_approve == 0){ ?>
										<label class="label label-warning">Menunggu Approval</label>
									<?php } else{ ?>
										<label class="label label-danger">Rejected</label>
									<?php } ?>
								</td>
								<td>
									<table style="border: 0">
										<tr>
											<td style="border-top: 0; padding: 0;">
												<a class="btn btn-success" href="<?=base_url('admin/update/'.$urisafe);?>" data-toggle="tooltip" title="Edit">
													<i class="ti-pencil-alt"></i>                                        
												</a>
											</td>
											<?php if ($data->status_approve == 1): ?>
												<td style="border-top: 0; padding: 0;">
													<a class="btn btn-warning" href="<?=base_url('admin/print_qr/'.$urisafe);?>" target="_blank" data-toggle="tooltip" title="Print">
														<i class="ti-printer"></i>                                        
													</a>
												</td>
												<td style="border-top: 0; padding: 0;">
													<a class="btn btn-info" href="<?=base_url($data->qr_image);?>" target="_blank"  data-toggle="tooltip" title="Download">
														<i class="ti-download"></i>                                      
													</a>
												</td>
											<?php endif ?>
										</tr>
									</table>
									
									
									
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