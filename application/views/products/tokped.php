<div class="row">
<!-- Column -->
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12 col-lg-3">
						<form>
	                        <div class="input-group mb-3">
	                            <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
	                            <div class="input-group-append">
	                                <button class="btn btn-success" type="button"><i class="ti-search"></i></button>
	                            </div>
	                        </div>
	                    </form>
	                </div>
			        <div class="col-sm-12 col-lg-9">
			            <!--Tampilkan pagination-->
			            <?php echo $pagination; ?>
			        </div>
			    </div>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Image</th>
								<th>ID</th>
								<th>Kode Produk</th>
								<th>Nama</th>
								<th>Harga RD</th>
								<th>Harga Tokped</th>
								<th>Stok Tokped</th>
								<th>Stok RD</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 1;
							if (!empty($products)): ?>
							<?php foreach($products as $product) : 
							?>
							<tr>
								<td> <img src="<?=$product->image?>" width="80"> </td>
								<td><?=$product->id?></td>
								<td><?=$product->code_product?></td>
								<td><?=$product->name?></td>
								<td><?=$product->rd_price?></td>
								<td><?=$product->harga_tokped?></td>
								<td><?php
									foreach ($product->varian as $varian) {
										if ($varian->stok_tokped <= 0) {
											echo "<span style='color:red;''>";
										}else{
											echo "<span>";
										}
										echo $varian->varian_name." - ".$varian->stok_tokped."</span></br>";
									}
									
								?></td>
								<td><?php
									foreach ($product->rd_stock as $rd_stock) {
										if ($rd_stock->stock <= 0) {
											echo "<span style='color:red;''>";
										}else{
											echo "<span>";
										}
										echo $rd_stock->size->name." - ".$rd_stock->stock."</span></br>";
									}
								?></td>
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