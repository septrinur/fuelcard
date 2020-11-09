<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Upload Data</h4>
                <h6 class="card-subtitle">Form untuk Upload data secara massal.</h6>
            </div>
            <hr>
                    <center><?php if (!empty($error)) { ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php } ?></center>
             <?=form_open_multipart(site_url('admin/upload'),array('class'=>'form-horizontal needs-validation', 'novalidate'=>''));?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label for="file" class="col-sm-3 text-right control-label col-form-label">File</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" id="file" name="file">
                                    (File Format Harus XLS,XLSx,CSV maximal ukuran 10mb)
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