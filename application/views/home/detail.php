<div class="single-thumb-vertical main-container shop-page no-sidebar">
    <div class="container">
        <div class="row">
            <div class="main-content col-md-12">
                <div class="lynessa-notices-wrapper"></div>
                <div id="product-27"
                     class="post-27 product type-product status-publish has-post-thumbnail product_cat-table product_cat-new-arrivals product_cat-lamp product_tag-table product_tag-sock first instock shipping-taxable purchasable product-type-variable has-default-attributes">
                    <div class="main-contain-summary">
                        <div class="contain-left has-gallery">
                            <div class="single-left">
                                <div class="lynessa-product-gallery lynessa-product-gallery--with-images lynessa-product-gallery--columns-4 images">
                                    <div class="flex-viewport">
                                        <figure class="lynessa-product-gallery__wrapper">
                                            <?php foreach ($product['image'] as $img) { 
                                                if($img != ''){?>
                                                <div class="lynessa-product-gallery__image">
                                                <img alt="img"
                                                     src="https://www.resellerdropship.com/<?=$img?>">
                                            </div>
                                            <?php } } ?>
                                        </figure>
                                    </div>
                                    <ol class="flex-control-nav flex-control-thumbs">
                                        <?php foreach ($product['image'] as $img) { 
                                            if($img != ''){?>
                                            <li><img
                                                src="https://www.resellerdropship.com/<?=$img?>"
                                                alt="img">
                                            </li>
                                        <?php } } ?>
                                    </ol>
                                </div>
                            </div>
                            <div class="summary entry-summary">
                                <div class="flash">
                                    <?php if ($product['disc'] > 0) { ?>
                                        <span class="onsale"><span class="number">-<?=$product['disc']?>%</span></span>
                                    <?php } ?>
                                </div>
                                <h1 class="product_title entry-title"><?=$product['name']?></h1>
                                <p class="price">
                                    <span class="lynessa-Price-amount amount">
                                        <span class="lynessa-Price-currencySymbol">Rp</span>
                                        <?=number_format($product['price'],0,',','.')?>
                                    </span>
                                </p>
                                <p class="stock in-stock">
                                    Availability: <span> In stock</span>
                                </p>
                                <form class="variations_form cart">
                                    <div class="single_variation_wrap">
                                        <div class="lynessa-variation single_variation"></div>
                                        <div class="btn-wa">
                                            <a href="<?=$contact[3]->url.'Aku mau beli '.$product['name'].'...Link: '.base_url(uri_string())?>" target="_blank">
                                                <img src="<?=base_url();?>landing/assets/images/logo-wa.png" class="az_single_image-img attachment-full" alt="img" width="32" height="32"> Beli Via WhatsApp
                                            </a>
                                        </div>
                                        <?php if ($product['tokped'] == 1 ) { ?>
                                        <div class="btn-tokped">
                                            <a href="<?=$product['tokped_link']?>" target="_blank">
                                                <img src="<?=base_url();?>landing/assets/images/logo-tokped.png" class="az_single_image-img attachment-full" alt="img" width="32" height="32"> Beli Di Tokopedia
                                            </a>
                                        </div>
                                        <?php } ?>
                                        <?php if ($product['shopee'] == 1 ) { ?>
                                        <div class="btn-shopee">
                                            <a href="<?=$product['shopee_link']?>" target="_blank">
                                                <img src="<?=base_url();?>landing/assets/images/logo-shopee.png" class="az_single_image-img attachment-full" alt="img" width="32" height="32"> Beli Di Shopee
                                            </a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </form>
                                <div class="product_meta">
                                    <span class="sku_wrapper">SKU: <span class="sku"><?=$product['code']?></span></span>
                                    <span class="posted_in">
                                        Categories: <a href="#" rel="tag"><?=$product['category_name']?></a>
                                    </span>
                                    <span class="sku_wrapper">Weight: <span class="sku"><?=$product['weight']?> kg</span></span>
                                    <span class="sku_wrapper">Total Stock: <span class="sku"><?=$product['total_stock']?></span></span>
                                </div>
                                <div class="lynessa-share-socials">
                                    <h5 class="social-heading">Share: </h5>
                                    <a target="_blank" class="facebook" href="#">
                                        <i class="fa fa-facebook-f"></i>
                                    </a>
                                    <a target="_blank" class="twitter"
                                       href="#"><i class="fa fa-twitter"></i>
                                    </a>
                                    <a target="_blank" class="pinterest"
                                       href="#"> <i class="fa fa-pinterest"></i>
                                    </a>
                                    <a target="_blank" class="googleplus"
                                       href="#"><i class="fa fa-google-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lynessa-tabs lynessa-tabs-wrapper">
                        <ul class="tabs dreaming-tabs" role="tablist">
                            <li class="description_tab active" id="tab-title-description" role="tab"
                                aria-controls="tab-description">
                                <a href="#tab-description">Description</a>
                            </li>
                            <li class="additional_information_tab" id="tab-title-additional_information" role="tab"
                                aria-controls="tab-additional_information">
                                <a href="#tab-additional_information">Stock</a>
                            </li>
                        </ul>
                        <div class="lynessa-Tabs-panel lynessa-Tabs-panel--description panel entry-content lynessa-tab"
                             id="tab-description" role="tabpanel" aria-labelledby="tab-title-description">
                            <h2>Description</h2>
                            <div class="container-table">
                                <div class="container-cell">
                                    <p><?=str_replace('?','',$product['description'])?></p>
                                </div>
                            </div>
                        </div>
                        <div class="lynessa-Tabs-panel lynessa-Tabs-panel--additional_information panel entry-content lynessa-tab"
                             id="tab-additional_information" role="tabpanel"
                             aria-labelledby="tab-title-additional_information">
                            <h2>Stock</h2>
                            <table class="shop_attributes">
                                <tbody>
                                    <?php foreach ($product['stock'] as $stock) { ?>
                                         <tr>
                                            <th><?=$stock->size->name?></th>
                                            <td><p><?=$stock->stock?></p>
                                            </td>
                                        </tr>
                                   <?php  } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 dreaming_related-product">
                <div class="block-title">
                    <h2 class="product-grid-title">
                        Related Products
                        <span></span>
                    </h2>
                </div>
                <div class="owl-slick owl-products equal-container better-height"
                     data-slick="{&quot;arrows&quot;:false,&quot;slidesMargin&quot;:30,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;slidesToShow&quot;:4}"
                     data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;30&quot;}}]">
                    <?php foreach ($favourites as $product) { ?>
                        <div class="product-item recent-product style-04 rows-space-0 post-93 product type-product status-publish has-post-thumbnail product_cat-light product_cat-table product_cat-new-arrivals product_tag-table product_tag-sock first instock shipping-taxable purchasable product-type-simple  ">
                            <div class="product-inner tooltip-top tooltip-all-top">
                                <div class="product-thumb">
                                    <a class="thumb-link"
                                       href="<?=base_url();?>home/detail/<?=$product->name_code.'?id='.$product->id?>" tabindex="0">
                                        <img class="img-responsive"
                                             src="<?=$product->image?>"
                                             alt="KNIT LIKE" width="270" height="350">
                                    </a>
                                    <div class="flash">
                                        <?php if ($product->disc > 0) { ?>
                                            <span class="onsale"><span class="number">-<?=$product->disc?>%</span></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3 class="product-name product_title">
                                        <a href="<?=base_url();?>home/detail/<?=$product->name_code.'?id='.$product->id?>"
                                           tabindex="0"><?=$product->name?></a>
                                    </h3>
                                    <span class="price"><span class="lynessa-Price-amount amount"><span
                                            class="lynessa-Price-currencySymbol">Rp </span><?=number_format($product->price,0,',','.')?></span></span>
                                    <div class="rating-wapper nostar">

                                    </div>
                                </div>
                            </div>
                        </div>
                     <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>