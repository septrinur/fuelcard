<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Baru Pengguna Aplikasi</h4>
                <h6 class="card-subtitle">Form untuk penambahan data admin pada aplikasi FuelCard QR.</h6>
            </div>
            <hr>
                    <center><?php if (!empty($error)) { ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php } ?></center>
             <?=form_open(site_url('user/create'),array('class'=>'form-horizontal needs-validation', 'novalidate'=>''));?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 text-right control-label col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo (isset($param)) ? $param['username'] : ''; ?>" required>
                                    <div class="invalid-feedback">
                                      Tidak boleh kosong.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 text-right control-label col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="password" name="password" value="<?php echo (isset($param)) ? $param['password'] : ''; ?>" required>
                                    <div class="invalid-feedback">
                                      Tidak boleh kosong.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 text-right control-label col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo (isset($param)) ? $param['name'] : ''; ?>" required>
                                    <div class="invalid-feedback">
                                      Tidak boleh kosong.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="no_hp" class="col-sm-3 text-right control-label col-form-label">No Handphone</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?php echo (isset($param)) ? $param['no_hp'] : ''; ?>" required>
                                    <div class="invalid-feedback">
                                      Tidak boleh kosong.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="spbu" class="col-sm-3 text-right control-label col-form-label">SPBU</label>
                                <div class="col-sm-9">
                                    <select class="form-control custom-select" name="spbu_id" required>
                                        <option value="">Pilih SPBU</option>
                                        <?php foreach ($spbus as $spbu) { ?>
                                            <option value="<?=$spbu->id_spbu?>"><?=$spbu->nama_spbu?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback">
                                      Tidak boleh kosong.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                            
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <div class="form-group m-b-0 text-right">
                        <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                        <button type="submit" class="btn btn-dark waves-effect waves-light">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>