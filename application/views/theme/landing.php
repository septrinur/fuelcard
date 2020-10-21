<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url();?>landing/assets/images/favicon.ico"/>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>landing/assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>landing/assets/css/animate.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>landing/assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>landing/assets/css/chosen.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>landing/assets/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>landing/assets/css/pe-icon-7-stroke.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>landing/assets/css/jquery.scrollbar.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>landing/assets/css/lightbox.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>landing/assets/css/magnific-popup.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>landing/assets/css/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>landing/assets/fonts/flaticon.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>landing/assets/css/megamenu.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>landing/assets/css/dreaming-attribute.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>landing/assets/css/style.css"/>
    <style type="text/css">
        .show-more a{
            display: inline-block;
            height: 44px;
            line-height: 44px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #ffffff;
            padding: 0 35px;
            background: #e3c268;
        }

        .btn-shopee a{
            display: inline-block;
            height: 44px;
            line-height: 44px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #ffffff;
            padding: 0 35px;
            background: #FE6132;
            margin-bottom: 15px;
        }

        .btn-wa a{
            display: inline-block;
            height: 44px;
            line-height: 44px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #ffffff;
            padding: 0 35px;
            background: #59F675;
            margin-bottom: 15px;
        }


        .btn-tokped a{
            display: inline-block;
            height: 44px;
            line-height: 44px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #ffffff;
            padding: 0 35px;
            background: #54AE4A;
            margin-bottom: 15px;
        }

        .vertical-center {
          margin: 0;
          position: absolute;
          top: 50%;
          -ms-transform: translateY(-50%);
          transform: translateY(-50%);
        }
        .show-more a:hover{
            background-color: #000;
        }
        }
    </style>
    <title>HagiaStore - Your Partner in Style</title>
</head>
<body>
<header id="header" class="header style-04 header-sticky">
    <div class="header-middle">
        <div class="header-middle-inner">
            <div class="header-search-mid">
                <div class="header-search">
                    <div class="block-search">
                         <?=form_open(site_url('home/products'),array('method'=>'get','class'=>'form-search block-search-form lynessa-live-search-form'));?>
                            <div class="form-content search-box results-search">
                                <div class="inner">
                                    <input autocomplete="off" class="searchfield txt-livesearch input" name="s"
                                           value="" placeholder="Search here..." type="text">
                                </div>
                            </div>
                            <button type="submit" class="btn-submit">
                                <span class="pe-7s-search"></span>
                            </button>
                        </form><!-- block search -->
                    </div>
                </div>
            </div>
            <div class="header-logo-menu">
                <div class="block-menu-bar">
                    <a class="menu-bar menu-toggle" href="#">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                </div>
                <div class="header-logo">
                    <a href="<?=base_url();?>"><img style="height=56;" alt="Lynessa" src="<?=base_url();?>landing/assets/images/logo-hagia-circle.png" class="logo" width="64" height="64"></a></div>
            </div>
            <div class="header-control">
                <div class="header-control-inner">
                    <div class="meta-dreaming">
                        <div class="menu-item block-user block-dreaming lynessa-dropdown">
                            
                        </div>
                        <div class="block-minicart block-dreaming lynessa-mini-cart lynessa-dropdown">
                            <div class="shopcart-dropdown block-cart-link" data-lynessa="lynessa-dropdown">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-wrap-stick">
        <div class="header-position">
            <div class="header-nav">
                <div class="container">
                    <div class="lynessa-menu-wapper"></div>
                    <div class="header-nav-inner">
                        <div class="box-header-nav menu-nocenter">
                            <ul id="menu-primary-menu"
                                class="clone-main-menu lynessa-clone-mobile-menu lynessa-nav main-menu">
                                <li id="menu-item-230"
                                    class="menu-item menu-item-type-post_type menu-item-230 parent">
                                    <a class="lynessa-menu-item-title" title="Home" href="<?=base_url();?>">Home</a>
                                </li>
                                <?php foreach ($categories as $category) { ?>
                                    <li id="menu-item-228"
                                        class="menu-item menu-item-type-post_type menu-item-object-megamenu menu-item-228 parent parent-megamenu item-megamenu menu-item-has-children">
                                        <a class="lynessa-menu-item-title" title="<?=$category->name?>"
                                           href="#"><?=$category->name?></a>
                                        <span class="toggle-submenu"></span>
                                        <div class="submenu megamenu megamenu-shop">
                                            <div class="row">
                                                <?php foreach ($category->childs as $subcategory) { 
                                                    if ($subcategory->child != 0) { ?>
                                                        <div class="col-md-4">
                                                            <div class="lynessa-listitem style-01">
                                                                <div class="listitem-inner">
                                                                    <h4 class="title"><?=$subcategory->name?></h4>
                                                                    <ul class="listitem-list">
                                                                        <?php foreach ($subcategory->childs as $cat) { ?>
                                                                            <li>
                                                                                <a href="<?=base_url();?>home/products?cat=<?=$cat->id?>" target="_self"><?=$cat->name?></a>
                                                                            </li>
                                                                        <?php } ?> 
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php }else{ ?>
                                                        <div class="col-md-4">
                                                            <div class="lynessa-listitem style-01">
                                                                <div class="listitem-inner">
                                                                    <ul class="listitem-list">
                                                                        <h4 class="title"><?=$subcategory->name?></h4>
                                                                        <li>
                                                                            <a href="<?=base_url();?>home/products?cat=<?=$subcategory->id?>" target="_self"><?=$subcategory->name?></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-mobile">
        <div class="header-mobile-left">
            <div class="block-menu-bar">
                <a class="menu-bar menu-toggle" href="#">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
            </div>
        </div>
        <div class="header-mobile-mid">
            <div class="header-logo">
                <a href="<?=base_url();?>"><img alt="Lynessa"
                                          src="<?=base_url();?>landing/assets/images/logo-hagia-circle.png"
                                          class="logo" width="56" height="56"></a></div>
        </div>
        <div class="header-mobile-right">
            <div class="header-control-inner">
                <div class="meta-dreaming">
                     <div class="header-search lynessa-dropdown">
                        <div class="header-search-inner" data-lynessa="lynessa-dropdown">
                            <a href="#" class="link-dropdown block-link">
                                <span class="pe-7s-search"></span>
                            </a>
                        </div>
                        <div class="block-search">
                            <?=form_open(site_url('home/products'),array('method'=>'get','class'=>'form-search block-search-form lynessa-live-search-form'));?>
                                <div class="form-content search-box results-search">
                                    <div class="inner">
                                        <input autocomplete="off" class="searchfield txt-livesearch input" name="s" value=""
                                               placeholder="Search here..." type="text">
                                    </div>
                                </div>
                                <button type="submit" class="btn-submit">
                                    <span class="pe-7s-search"></span>
                                </button>
                            </form><!-- block search -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<?php echo $main_content; ?>
<footer id="footer" class="footer style-04">
    <div class="section-025">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 d-lg-none">
                    <div class="logo-footer">
                        <img src="<?=base_url();?>landing/assets/images/logo-hagia-circle.png"
                             class="az_single_image-img attachment-full" alt="img" width="128" height="128">
                    </div>
                    <div class="footer-desc">Your Partner in Style.
                    </div>
                    <div style="text-align: center;" class="">
                        <div class="">
                            <ul class="">
                                <li style="display: inline-block;height: 38px;margin-right: 20px;margin-top: 14px;">
                                    <a href="https://www.tokopedia.com/hagia-store" target="_blank">
                                         <img src="<?=base_url();?>landing/assets/images/logo-tokped.png" class="az_single_image-img attachment-full" alt="img" width="32" height="32"></i>
                                    </a>
                                </li>
                                <li style="display: inline-block;height: 38px;margin-right: 20px;margin-top: 14px;">
                                    <a href="https://shopee.co.id/hagiastore_" target="_blank">
                                        <img src="<?=base_url();?>landing/assets/images/logo-shopee.png" class="az_single_image-img attachment-full" alt="img" width="32" height="32"></i>
                                    </a>
                                </li>
                                <li style="display: inline-block;height: 38px;margin-right: 20px;margin-top: 14px;">
                                    <a href="https://www.instagram.com/hagiastore_" target="_blank">
                                        <img src="<?=base_url();?>landing/assets/images/logo-ig.png" class="az_single_image-img attachment-full" alt="img" width="32" height="32"></i>
                                    </a>
                                </li>
                                <li style="display: inline-block;height: 38px;margin-right: 20px;margin-top: 14px;">
                                    <a href="https://wa.me/6289671425666?text=Halo%20Hagia%20Store…" target="_blank">
                                        <img src="<?=base_url();?>landing/assets/images/logo-wa.png" class="az_single_image-img attachment-full" alt="img" width="32" height="32"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="logo-footer">
                        <img src="<?=base_url();?>landing/assets/images/logo-hagia-circle.png"
                             class="az_single_image-img attachment-full" alt="img" width="128" height="128">
                    </div>
                    <div class="footer-desc">
                        Your Partner in Style.<br/>
                    </div>
                    <div style="text-align: center;" class="">
                        <div class="">
                            <ul class="">
                                <li style="display: inline-block;height: 38px;margin-right: 20px;margin-top: 14px;">
                                    <a href="https://www.tokopedia.com/hagia-store" target="_blank">
                                         <img src="<?=base_url();?>landing/assets/images/logo-tokped.png" class="az_single_image-img attachment-full" alt="img" width="32" height="32"></i>
                                    </a>
                                </li>
                                <li style="display: inline-block;height: 38px;margin-right: 20px;margin-top: 14px;">
                                    <a href="https://shopee.co.id/hagiastore_" target="_blank">
                                        <img src="<?=base_url();?>landing/assets/images/logo-shopee.png" class="az_single_image-img attachment-full" alt="img" width="32" height="32"></i>
                                    </a>
                                </li>
                                <li style="display: inline-block;height: 38px;margin-right: 20px;margin-top: 14px;">
                                    <a href="https://www.instagram.com/hagiastore_" target="_blank">
                                        <img src="<?=base_url();?>landing/assets/images/logo-ig.png" class="az_single_image-img attachment-full" alt="img" width="32" height="32"></i>
                                    </a>
                                </li>
                                <li style="display: inline-block;height: 38px;margin-right: 20px;margin-top: 14px;">
                                    <a href="https://wa.me/6289671425666?text=Halo%20Hagia%20Store…" target="_blank">
                                        <img src="<?=base_url();?>landing/assets/images/logo-wa.png" class="az_single_image-img attachment-full" alt="img" width="32" height="32"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                </div>
            </div>
        </div>
    </div>
    <div class="section-016">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>© Copyright 2020. All Rights Reserved.</p>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </div>
</footer>
<a href="#" class="backtotop active">
    <i class="fa fa-angle-up"></i>
</a>
<script src="<?=base_url();?>landing/assets/js/jquery-1.12.4.min.js"></script>
<script src="<?=base_url();?>landing/assets/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>landing/assets/js/chosen.min.js"></script>
<script src="<?=base_url();?>landing/assets/js/countdown.min.js"></script>
<script src="<?=base_url();?>landing/assets/js/jquery.scrollbar.min.js"></script>
<script src="<?=base_url();?>landing/assets/js/lightbox.min.js"></script>
<script src="<?=base_url();?>landing/assets/js/magnific-popup.min.js"></script>
<script src="<?=base_url();?>landing/assets/js/slick.js"></script>
<script src="<?=base_url();?>landing/assets/js/jquery.zoom.min.js"></script>
<script src="<?=base_url();?>landing/assets/js/threesixty.min.js"></script>
<script src="<?=base_url();?>landing/assets/js/jquery-ui.min.js"></script>
<script src="<?=base_url();?>landing/assets/js/mobilemenu.js"></script>
<script src="<?=base_url();?>landing/assets/js/functions.js"></script>
</body>
</html>