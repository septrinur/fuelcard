<div class="row">
    <div class="col-sm-12">
        <div class="card card-body">
            <h4 class="card-title">Add Products</h4>
            <?=form_open(site_url('product/add'),array('class'=>'form-horizontal mt-4'));?>
            <form class="form-horizontal mt-4">
                <div class="form-group">
                    <label>Kode Produk</label>
                    <input type="text" class="form-control" name="code_product">
                </div>
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label>Deskripsi Produk</label>
                    <textarea cols="80" id="testedit" name="description" rows="10" data-sample="1"data-sample-short>
                                    
                    </textarea>
                </div>
                <div class="form-group row pt-3">
                    <div class="col-sm-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="tokped" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Tokopedia</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="shopee" class="custom-control-input" id="customCheck2">
                            <label class="custom-control-label" for="customCheck2">Shopee</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Harga Tokped</label>
                    <input type="text" class="form-control" name="harga_tokped">
                </div>
                <div class="form-group">
                    <label>Harga Shopee</label>
                    <input type="text" class="form-control" name="harga_shopee">
                </div>
                <div class="form-group">
                    <label>Tokped Link</label>
                    <input type="text" class="form-control" name="tokped_link">
                </div>
                <div class="form-group">
                    <label>Shopee Link</label>
                    <input type="text" class="form-control" name="shopee_link">
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Varian</h4>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="varian_name" name="varian_name[]" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="stok_tokped" name="stok_tokped[]" placeholder="Stok Tokped">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="stok_shopee" name="stok_shopee[]" placeholder="Stok Shopee">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <button class="btn btn-success" type="button" onclick="education_fields();"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div id="education_fields" class=" m-t-20"></div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>