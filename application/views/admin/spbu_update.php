<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data SPBU</h4>
                <h6 class="card-subtitle">Form untuk melakukan perubahan data spbu pada aplikasi FuelCard QR.</h6>
            </div>
            <hr>
                    <center><?php if (!empty($error)) { ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php } ?></center>
             <?=form_open(site_url('admin/spbu_update/'.$id),array('class'=>'form-horizontal needs-validation', 'novalidate'=>''));?>
             <input type="hidden" name="id_spbu" value="<?=$param['id_spbu']?>">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="no_spbu" class="col-sm-3 text-right control-label col-form-label">No SPBU</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="no_spbu" name="no_spbu" value="<?php echo (isset($param)) ? $param['no_spbu'] : ''; ?>" required>
                                    <div class="invalid-feedback">
                                      Tidak boleh kosong.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="nama_spbu" class="col-sm-3 text-right control-label col-form-label">Nama SPBU</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama_spbu" name="nama_spbu" value="<?php echo (isset($param)) ? $param['nama_spbu'] : ''; ?>" required>
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
                                <label for="wilayah" class="col-sm-3 text-right control-label col-form-label">Wilayah</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="wilayah" name="wilayah" value="<?php echo (isset($param)) ? $param['wilayah'] : ''; ?>" required>
                                    <div class="invalid-feedback">
                                      Tidak boleh kosong.
                                    </div>
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