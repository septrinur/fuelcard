<div class="row">
    <div class="col-sm-6">
        <div class="card card-body">
            <h4 class="card-title">Setting Price</h4>
            <?=form_open(site_url('setting/index'),array('class'=>'form-horizontal mt-4'));?>
            <form class="form-horizontal mt-4">
                <div class="form-group">
                    <label>Mark Up Price</label>
                    <input id="demo3" type="text" value="<?=$markup[0]->up?>" name="up">
                </div>
                <div class="form-group">
                    <label>Discount</label>
                    <input id="demo3" type="text" value="$markup[0]->disc" name="disc">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>