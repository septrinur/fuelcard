<div class="main-container shop-page no-sidebar">
    <div class="container">
        <div class="row">
            <div class="main-content col-md-12">
                <div class="shop-control shop-before-control">
                    <form class="lynessa-ordering" method="get">
                    <?=form_open(site_url('home/products'),array('class'=>'lynessa-ordering', 'method'=>'get'));?>
                        <select title="product_cat" name="orderby" class="orderby">
                            <?php if ($sort == 6) { ?>
                                <option value="6" selected="selected">Default sorting</option>
                            <?php }else{ ?>  
                                <option value="6">Default sorting</option>
                            <?php } ?>
                            <?php if ($sort == 1) { ?>
                                <option value="1" selected="selected">Sort by recomendation</option>
                            <?php }else{ ?>  
                                <option value="1">Sort by recomendation</option>                           
                            <?php } ?>
                            <?php if ($sort == 7) { ?>
                                <option value="7" selected="selected">Sort by latest</option>
                            <?php }else{ ?>  
                                <option value="7">Sort by latest</option>                          
                            <?php } ?>
                            <?php if ($sort == 2) { ?>
                                <option value="2" selected="selected">Sort by price: low to high</option>  
                            <?php }else{ ?>  
                                <option value="2">Sort by price: low to high</option>                          
                            <?php } ?>
                            <?php if ($sort == 5) { ?>
                                <option value="5" selected="selected">Sort by price: high to low</option>
                            <?php }else{ ?>  
                                <option value="5">Sort by price: high to low</option>                                
                            <?php } ?>
                        </select>
                        <?php if ($search != '') { ?>
                            <input type="hidden" name="s" value="<?=$search?>">
                        <?php } ?>
                        <?php if ($cat != '') { ?>
                            <input type="hidden" name="cat" value="<?=$cat?>">
                        <?php } ?>
                    <button type="submit"
                            class="single_add_to_cart_button button alt lynessa-variation-selection-needed">
                        SUBMIT
                    </button>
                    </form>
                </div>
                <div class=" auto-clear lynessa-products">
                    <ul class="row products columns-3">
                        <?php foreach ($products as $product) { ?>
                        <li class="product-item wow fadeInUp product-item rows-space-30 col-bg-3 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-ts-6 style-01 post-30 product type-product status-publish has-post-thumbnail product_cat-light product_cat-bed product_cat-specials product_tag-light product_tag-table product_tag-sock last instock featured downloadable shipping-taxable purchasable product-type-simple"
                            data-wow-duration="1s" data-wow-delay="0ms" data-wow="fadeInUp">
                            <div class="product-inner tooltip-left">
                                <div class="product-thumb">
                                    <a class="thumb-link" href="<?=base_url();?>home/detail/<?=$product['name_code'].'?id='.$product['id']?>">
                                        <img class="img-responsive"
                                             src="<?=$product['image']?>"
                                             alt="STRIPE SKIRTS" width="600" height="778">
                                    </a>
                                    <div class="flash">
                                        <?php if ($product['disc'] > 0) { ?>
                                            <span class="onsale"><span class="number">-<?=$product['disc']?>%</span></span>
                                        <?php } ?>
                                    <a href="<?=base_url();?>home/detail/<?=$product['name_code'].'?id='.$product['id']?>" class="button yith-wcqv-button" data-product_id="24">Quick View</a>
                                </div>
                                <div class="product-info equal-elem">
                                    <h3 class="product-name product_title">
                                        <a href="<?=base_url();?>home/detail/<?=$product['name_code'].'?id='.$product['id']?>"><?=$product['name']?></a>
                                    </h3>
                                    <div class="rating-wapper nostar">
                                        
                                    </div>
                                    <span class="price"><span class="lynessa-Price-amount amount"><span
                                            class="lynessa-Price-currencySymbol">Rp</span><?=number_format($product['price'],0,',','.')?></span></span>
                                    <div class="lynessa-product-details__short-description">
                                        
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="shop-control shop-after-control">
                    <?php 
                    $query = '';
                    if ($search != '') {
                        $query = 'orderby='.$sort.'&s='.$search;
                    }else{
                        $query = 'orderby='.$sort;
                    } ?>
                    <?php if ($cat != '') {
                        $query = $query.'&cat='.$cat;
                    } ?>
                    <nav class="lynessa-pagination">
                        <?php if ($metadata->currentPage != 1) { ?>    
                            <a class="page-numbers" href="<?=base_url();?>home/products?<?=$query?>&page=1">First</a>
                        <?php } ?>
                        <span class="page-numbers current"><?=$metadata->currentPage?></span>
                        <a class="page-numbers" href="<?=base_url();?>home/products?<?=$query?>&page=<?=$metadata->currentPage+1?>"><?=$metadata->currentPage+1?></a>
                        <a class="last page-numbers" href="<?=base_url();?>home/products?<?=$query?>&page=<?=$metadata->lastPage?>">Last</a>
                    </nav>
                    <p class="lynessa-result-count">Showing <?=$metadata->fromItem?>-<?=$metadata->toItem?> of <?=$metadata->total?> results</p>
                </div>
            </div>
        </div>
    </div>
</div>