<div class="row">
<!-- Column -->
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Data Pengguna Aplikasi</h4>
                <h6 class="card-subtitle"></h6>
                <center>
                	<?php if ($this->session->flashdata('user_success') != null) { ?>
                		<div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            <h3 class="text-success"><i class="fa fa-check-circle"></i> Berhasil</h3> 
                            <?php echo $this->session->flashdata('user_success'); ?>
                        </div>
                	<?php } ?>
                </center>
                <center>
                	<?php if ($this->session->flashdata('user_failed') != null) { ?>
                		<div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                            <h3 class="text-danger"><i class="fa fa-exclamation-triangle"></i> Terjadi Kesalahan</h3> 
                            <?php echo $this->session->flashdata('user_failed'); ?>
                        </div>
                	<?php } ?>
                </center>
                <a href="<?=base_url();?>user/create"><button type="button" class="btn btn-info btn-rounded m-t-10 mb-2 float-right">Input Data Baru</button></a>
				<div class="row">
					<div class="col-sm-12 col-lg-3">
						<?=form_open(site_url('user/aplikasi'),array('method'=>'get'));?>
	                        <div class="input-group mb-3">
	                            <input type="text" name="s" class="form-control" placeholder="Cari username, nama, no hp" aria-label="" aria-describedby="basic-addon1" value="<?php echo (isset($s)) ? $s : ''; ?>">
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
								<th>No</th>
								<th>Username</th>
								<th>Nama</th>
								<th>SPBU</th>
								<th>No HP</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 1;
							if (!empty($users)): ?>
							<?php foreach($users as $user) : 
								$base64 = $this->encryption->encrypt($user->id_user);
								$urisafe = strtr($base64, '+/=', '.-~');
							?>
							<tr>
								<td><?=$no?></td>
								<td><?=$user->username?></td>
								<td><?=$user->name?></td>
								<td><?=$user->nama_spbu?></td>
								<td><?=$user->no_hp?></td>
								<td>
									<?php if ($user->status == 1) { ?>
										<label class="label label-success">Aktif</label>
									<?php }else{ ?>
										<label class="label label-danger">Block</label>
									<?php } ?>
								</td>
								<td>
									<a class="btn btn-success" href="<?=base_url('user/edit/'.$urisafe);?>">
										<i class="ti-pencil-alt"></i> Edit                                        
									</a>
									<a class="btn btn-danger" href="<?=base_url('user/remove/'.$urisafe);?>" onclick="return confirm('Apakah Anda yakin menghapus data ini?')">
											<i class="ti-trash"></i> 
											Hapus
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