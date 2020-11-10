<div class="row">
<!-- column -->
	<div class="col-sm-12 col-lg-4">
		<div class="card bg-light-info no-card-border">
			<div class="card-body">
				<div class="d-flex align-items-center">
					<div class="m-r-10">
						<span>Data QR Sudah Disetujui</span>
						<h4><?=$dataqr?></h4>
					</div>
					<div class="ml-auto">
						<a href="<?=base_url('admin/export_dataqr');?>"><button type="button" class="btn btn-success btn-rounded m-t-10 mb-2 float-right">Download</button></a>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
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
				<!-- <div class="row">
					<div class="col-sm-12 col-lg-3">
						<?=form_open(site_url('admin/index'),array('method'=>'get'));?>
	                        <div class="input-group mb-3">
	                            <input type="text" name="s" class="form-control" placeholder="Cari Nama SPBU" aria-label="" aria-describedby="basic-addon1" value="<?php echo (isset($s)) ? $s : ''; ?>">
	                            <div class="input-group-append">
	                                <button class="btn btn-success" type="submit"><i class="ti-search"></i></button>
	                            </div>
	                        </div>
	                    </form>
	                </div>
			    </div> -->
			    <?php if (isset($periode)) {
                	$data_periode = 'periode='.$periode;
                }else{
                	$data_periode = '';
                } ?>
                <a href="<?=base_url('admin/export_data?'.$data_periode);?>"><button type="button" class="btn btn-success btn-rounded m-t-10 mb-2 float-right">Download</button></a>
				<div class="row">
					<div class="col-sm-12 col-lg-3">
						<?=form_open(site_url('admin/index'),array('method'=>'get'));?>
	                        <div class="input-group mb-3">
	                        	<label class="text-right control-label col-form-label">Periode</label> 
	                        	<select class="form-control custom-select" name="periode">
	                        		<option value="">Semua Periode</option>
	                        		<?php foreach ($months as $month) { ?>
	                        			<?php if (isset($periode)){ ?>
	                        				<?php if ($periode == $month['m']){ ?>
	                        					 <option value="<?=$month['m']?>" selected><?=bulan($month['m'])?></option>
	                        				<?php }else{ ?>
	                        					 <option value="<?=$month['m']?>"><?=bulan($month['m'])?></option>
	                        				<?php } ?>
	                        			<?php }else{ ?>
	                        				 <option value="<?=$month['m']?>"><?=bulan($month['m'])?></option>
	                        			<?php } ?>
	                        		<?php } ?>
	                        	</select>
	                            <div class="input-group-append">
	                                <button class="btn btn-success" type="submit"><i class="ti-search"></i></button>
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
								<th>Berhasil Scan</th>
								<th>Gagal Scan</th>
								<th>Total Scan</th>
								<th>Aksi</th>
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
								<td><?=$data->success_scan?></td>
								<td><?=$data->failed_scan?></td>
								<td><?=$data->total_scan?></td>
								<td>
									<a class="btn btn-success" href="<?=base_url('admin/detail?id='.$data->id_spbu);?>">
										Detail                                        
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