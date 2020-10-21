
<div class="fullwidth-template">
    <!--BANNER-->
    <div class="slide-home-02">
        <div class="response-product product-list-owl owl-slick equal-container better-height"
             data-slick="{&quot;arrows&quot;:false,&quot;slidesMargin&quot;:0,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:1,&quot;rows&quot;:1}"
             data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesMargin&quot;:&quot;0&quot;}}]">

            <div class="slide-wrap">
                <img src="<?=base_url();?>landing/assets/images/slide1.png" alt="image">
                <div class="slide-info">
                </div>
            </div>
            <div class="slide-wrap">
                <img src="<?=base_url();?>landing/assets/images/slide2.png" alt="image">
                <div class="slide-info">
                    <div class="container">
                        <div class="slide-inner">
                            <h2>Sneak a Pair Today!</h2>
                            <h1>Best Seller</h1>
                            <a href="<?=base_url();?>home/detail/sepatu-sneakers-pria-ksu-kzr-378?id=21224">Shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END BANNER-->
    <!--CARD-->
    <div class="section-001 section-004">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="lynessa-banner style-04 left-center">
                        <div class="banner-inner">
                            <figure class="banner-thumb">
                                <img src="<?=base_url();?>landing/assets/images/slide43.png"
                                     class="attachment-full size-full" alt="img">
                            </figure>
                            <div class="banner-info ">
                                <div class="banner-content">
                                    <div class="title-wrap">
                                        <h6 class="title">Best</h6>
                                    </div>
                                    <div class="cate">Selling</div>
                                    <div class="button-wrap">
                                        <div class="subtitle">Big Sale Week</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="lynessa-banner style-04 left-center">
                        <div class="banner-inner">
                            <figure class="banner-thumb">
                                <img src="<?=base_url();?>landing/assets/images/slide41.png"
                                     class="attachment-full size-full" alt="img">
                            </figure>
                            <div class="banner-info ">
                                <div class="banner-content">
                                    <div class="title-wrap">
                                        <h6 class="title">New</h6>
                                    </div>
                                    <div class="cate">Collection</div>
                                    <div class="button-wrap">
                                        <div class="subtitle">Available Now</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END CARD-->
    <!--FAVOURITES-->
    <div class="section-012">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="lynessa-heading style-01">
                        <div class="heading-inner">
                            <h3 class="title">
                                Favourites <span></span></h3>
                            <div class="subtitle">
                                
                            </div>
                        </div>
                    </div>
                    <div class="lynessa-products style-04">
                        <div class="response-product product-list-owl owl-slick equal-container better-height"
                             data-slick="{&quot;arrows&quot;:true,&quot;slidesMargin&quot;:30,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:4,&quot;rows&quot;:1}"
                             data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesMargin&quot;:&quot;30&quot;}}]">
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
    </div>
    <!--END FAVOURITES-->
    <!--NEW ARRIVAL-->
    <div class="section-011">
        <div class="container">
            <div class="lynessa-heading style-01">
                <div class="heading-inner">
                    <h3 class="title">
                        New Arrival <span></span> </h3>
                    <div class="subtitle">
                        
                    </div>
                </div>
            </div>
            <div class="lynessa-products style-04">
                <div class="response-product product-list-owl owl-slick equal-container better-height"
                     data-slick="{&quot;arrows&quot;:true,&quot;slidesMargin&quot;:30,&quot;dots&quot;:true,&quot;infinite&quot;:false,&quot;speed&quot;:300,&quot;slidesToShow&quot;:4,&quot;rows&quot;:1}"
                     data-responsive="[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesMargin&quot;:&quot;10&quot;}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesMargin&quot;:&quot;20&quot;}},{&quot;breakpoint&quot;:1500,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesMargin&quot;:&quot;30&quot;}}]">
                     <?php foreach ($new_arrivals as $product) { ?>
                        <div class="product-item recent-product style-04 rows-space-0 post-93 product type-product status-publish has-post-thumbnail product_cat-light product_cat-table product_cat-new-arrivals product_tag-table product_tag-sock first instock shipping-taxable purchasable product-type-simple  ">
                            <div class="product-inner tooltip-top tooltip-all-top">
                                <div class="product-thumb">
                                    <a class="thumb-link"
                                       href="<?=base_url();?>home/detail/<?=$product['name_code'].'?id='.$product['id']?>" tabindex="0">
                                        <img class="img-responsive"
                                             src="<?=$product['image']?>"
                                             alt="<?=$product['name']?>" width="270" height="350">
                                    </a>
                                    <div class="flash">
                                        <?php if ($product['disc'] > 0) { ?>
                                            <span class="onsale"><span class="number">-<?=$product['disc']?>%</span></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3 class="product-name product_title">
                                        <a href="<?=base_url();?>home/detail/<?=$product['name_code'].'?id='.$product['id']?>"
                                           tabindex="0"><?=$product['name']?></a>
                                    </h3>
                                    <span class="price"><span class="lynessa-Price-amount amount"><span
                                            class="lynessa-Price-currencySymbol">Rp </span><?=number_format($product['price'],0,',','.')?></span></span>
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
    <!--END NEW ARRIVAL-->
</div>
<!--PRODUCT LIST-->
<div class="main-container shop-page no-sidebar">
    <div class="container">
        <div class="row">
            <div class="main-content col-md-12">
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
                    <center><span class="show-more"><a href="<?=base_url();?>home/products">Show More</a></span></center>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>