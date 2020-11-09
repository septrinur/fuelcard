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
                <?php if (isset($periode)) {
                	$data_periode = '&periode='.$periode;
                }else{
                	$data_periode = '';
                } ?>
                <a href="<?=base_url('admin/export?id='.$id.$data_periode);?>"><button type="button" class="btn btn-success btn-rounded m-t-10 mb-2 float-right">Download</button></a>
				<div class="row">
					<div class="col-sm-12 col-lg-3">
						<?=form_open(site_url('admin/detail'),array('method'=>'get'));?>
						<input type="hidden" name="id" value="<?=$id?>">
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
										<img src="<?=base_url().$data->image?>" width="150">
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