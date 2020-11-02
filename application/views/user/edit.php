<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Pengguna</h4>
                <h6 class="card-subtitle">Form untuk melakukan perubahan data pengguna pada aplikasi FuelCard QR.</h6>
            </div>
            <hr>
                    <center><?php if (!empty($error)) { ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php } ?></center>
             <?=form_open(site_url('user/edit/'.$id),array('class'=>'form-horizontal needs-validation', 'novalidate'=>''));?>
             <input type="hidden" name="id_user" value="<?=$param['id_user']?>">
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
                                    <input type="text" class="form-control" id="password" name="password">
                                    <div class="">
                                      *) Kosongkan jika tidak diubah
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
                                    <select class="form-control custom-select" name="spbu_id">
                                        <?php foreach ($spbus as $spbu) { 
                                            if ($spbu->id_spbu == $param['spbu_id']) { ?>
                                                <option value="<?=$spbu->id_spbu?>" selected><?=$spbu->nama_spbu?></option>
                                        <?php }else{ ?>
                                                <option value="<?=$spbu->id_spbu?>"><?=$spbu->nama_spbu?></option>
                                        <?php } } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                <?php if ($param['status'] == '1') { ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="1" checked>
                                        <label class="form-check-label" for="inlineRadio2">Aktif</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="0">
                                        <label class="form-check-label" for="inlineRadio1">Tidak Aktif</label>
                                    </div>
                                <?php }else{ ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="1">
                                        <label class="form-check-label" for="inlineRadio2">Aktif</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="0" checked>
                                        <label class="form-check-label" for="inlineRadio1">Tidak Aktif</label>
                                    </div>
                                <?php } ?>
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