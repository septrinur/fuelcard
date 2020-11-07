<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data QR Baru</h4>
                <h6 class="card-subtitle">Form untuk penambahan data QR pada aplikasi FuelCard QR.</h6>
            </div>
            <hr>
                    <center><?php if (!empty($error)) { ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php } ?></center>
             <?=form_open(site_url('admin/input'),array('class'=>'form-horizontal needs-validation', 'novalidate'=>''));?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="nama_pemilik" class="col-sm-3 text-right control-label col-form-label">Nama Pemilik</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" value="<?php echo (isset($param)) ? $param['nama_pemilik'] : ''; ?>" required>
                                    <div class="invalid-feedback">
                                      Tidak boleh kosong.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="no_pol" class="col-sm-3 text-right control-label col-form-label">No Polisi</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="no_pol" name="no_pol" value="<?php echo (isset($param)) ? $param['no_pol'] : ''; ?>" required>
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
                                <label for="kuota_bbm" class="col-sm-3 text-right control-label col-form-label">Kuota BBM</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="kuota_bbm" name="kuota_bbm" value="<?php echo (isset($param)) ? $param['kuota_bbm'] : ''; ?>" required>
                                    <div class="invalid-feedback">
                                      Tidak boleh kosong.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="jenis_kendaraan" class="col-sm-3 text-right control-label col-form-label">Jenis Kendaraan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="jenis_kendaraan" name="jenis_kendaraan" value="<?php echo (isset($param)) ? $param['jenis_kendaraan'] : ''; ?>" required>
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
                                <label for="no_kartu" class="col-sm-3 text-right control-label col-form-label">No Kartu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="no_kartu" name="no_kartu" value="<?php echo (isset($param)) ? $param['no_kartu'] : ''; ?>" required>
                                    <div class="invalid-feedback">
                                      Tidak boleh kosong.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="dokumen" class="col-sm-3 text-right control-label col-form-label">Dokumen</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="dokumen" name="dokumen" value="<?php echo (isset($param)) ? $param['dokumen'] : ''; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <div class="form-group m-b-0 text-right">
                        <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>