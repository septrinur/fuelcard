var room = 1;

function education_fields() {

    room++;
    var objTo = document.getElementById('education_fields')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass" + room);
    var rdiv = 'removeclass' + room;
    divtest.innerHTML = '<div class="row"><div class="col-sm-3"><div class="form-group"><input type="text" class="form-control" id="varian_name" name="varian_name[]" placeholder="Name"></div></div><div class="col-sm-2"> <div class="form-group"> <input type="text" class="form-control" id="stok_tokped" name="stok_tokped[]" placeholder="Stok Tokped"> </div></div><div class="col-sm-2"> <div class="form-group"> <input type="text" class="form-control" id="stok_shopee" name="stok_shopee[]" placeholder="Stok Shopee"> </div></div><div class="col-sm-2"> <div class="form-group"> <button class="btn btn-danger" type="button" onclick="remove_education_fields(' + room + ');"> <i class="fa fa-minus"></i> </button> </div></div></div>';

    objTo.appendChild(divtest)
}

function remove_education_fields(rid) {
    $('.removeclass' + rid).remove();
}