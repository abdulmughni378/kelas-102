<?php 
use yii\helpers\Html;
?>

<header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyStartAt': 147, 'stickySetTop': '-147px', 'stickyChangeLogo': false}">
    <div class="header-body">
        <div class="header-top">
            <div class="container"> 
                <div class="top-menu-area">
                    <a href="#">Links <i class="fa fa-caret-down"></i></a>
                    <ul class="top-menu">
                        <li><a href="demo-shop-4-myaccount.html">My Account</a></li>
                        <li><a href="#">Daily Deal</a></li>
                        <li><a href="#">My Wishlist</a></li>
                        <li><a href="demo-shop-4-blog.html">Blog</a></li>
                        <?php  
                            if (Yii::$app->user->isGuest) { ?>
                                <li><a href="<?php echo Yii::$app->urlManager->createUrl('/site/login')?>">Log in</a></li>
                        <?php } else { ?>
                                <li><a href="<?php echo Yii::$app->urlManager->createUrl('/site/logout')?>">Log Out</a></li>
                        <?php }
                        ?>
                    </ul>
                </div>
                <!-- <p class="welcome-msg">HELLO ALL</p> -->
            </div>
        </div>
        <div class="header-container container">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-logo">
                        <a href="/">
                            <!-- <img alt="Porto" width="111" height="51" src="<?=Yii::getAlias('@web')?>/template/img/logos/logo-blibor.png"> -->
                            <?php 
                                // use common\components\Content;
                                $content = new \common\components\Content;
                                echo $content->headerLogo(); ?>
                        </a>
                    </div>
                </div>
                <div class="header-column">
                    <div class="row">
                        <div class="cart-area">
                            <div class="custom-block">
                                <!-- <i class="fa fa-phone"></i> -->
                                <!-- <span>(+61) 857-3234-5766</span> -->
                                <!-- <span class="split"></span> -->
                                <a href="#">CONTACT US</a>
                            </div>

                            <div class="cart-dropdown">
                                <a href="#" class="cart-dropdown-icon">
                                    <i class="minicart-icon"></i>
                                    <span class="cart-info">
                                        <span class="cart-qty">2</span>
                                        <span class="cart-text">item(s)</span>
                                    </span>
                                </a>

                                <div class="cart-dropdownmenu right">
                                    <div class="dropdownmenu-wrapper">
                                        <div class="cart-products">
                                            <div class="product product-sm">
                                                <a href="#" class="btn-remove" title="Remove Product">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                                <figure class="product-image-area">
                                                    <a href="demo-shop-4-product-details.html" title="Product Name" class="product-image">
                                                        <img src="<?=Yii::getAlias('@web')?>/template/img/demos/shop/products/thumbs/cart-product1.jpg" alt="Product Name">
                                                    </a>
                                                </figure>
                                                <div class="product-details-area">
                                                    <h2 class="product-name"><a href="demo-shop-4-product-details.html" title="Product Name">Blue Women Top</a></h2>

                                                    <div class="cart-qty-price">
                                                        1 X 
                                                        <span class="product-price">$65.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product product-sm">
                                                <a href="#" class="btn-remove" title="Remove Product">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                                <figure class="product-image-area">
                                                    <a href="demo-shop-4-product-details.html" title="Product Name" class="product-image">
                                                        <img src="<?=Yii::getAlias('@web')?>/template/img/demos/shop/products/thumbs/cart-product2.jpg" alt="Product Name">
                                                    </a>
                                                </figure>
                                                <div class="product-details-area">
                                                    <h2 class="product-name"><a href="demo-shop-4-product-details.html" title="Product Name">Black Utility Top</a></h2>

                                                    <div class="cart-qty-price">
                                                        1 X 
                                                        <span class="product-price">$39.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="cart-totals">
                                            Total: <span>$104.00</span>
                                        </div>

                                        <div class="cart-actions">
                                            <a href="demo-shop-4-cart.html" class="btn btn-primary">View Cart</a>
                                            <a href="demo-shop-4-checkout.html" class="btn btn-primary">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="header-search">
                            <a href="#" class="search-toggle"><i class="fa fa-search"></i></a>
                            <form action="#" method="get">
                                <div class="header-search-wrapper">
                                    <input type="text" class="form-control" name="q" id="q" placeholder="Search..." required>
                                    <select id="cat" name="cat">
                                        <option value="">All Categories</option>
                                        <option value="4">Fashion</option>
                                        <option value="12">- Women</option>
                                        <option value="13">- Men</option>
                                        <option value="66">- Jewellery</option>
                                        <option value="67">- Kids Fashion</option>
                                        <option value="5">Electronics</option>
                                        <option value="21">- Smart TVs</option>
                                        <option value="22">- Cameras</option>
                                        <option value="63">- Games</option>
                                        <option value="7">Home &amp; Garden</option>
                                        <option value="11">Motors</option>
                                        <option value="31">- Cars and Trucks</option>
                                        <option value="32">- Motorcycles &amp; Powersports</option>
                                        <option value="33">- Parts &amp; Accessories</option>
                                        <option value="34">- Boats</option>
                                        <option value="57">- Auto Tools &amp; Supplies</option>
                                    </select>
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>

                        <a href="#" class="mmenu-toggle-btn" title="Toggle menu">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-container header-nav">
            <div class="container">
                <div class="header-nav-main">
                    <nav>
                        <ul class="nav nav-pills" id="mainNav">
                            <li class="dropdown active">
                                <a class="dropdown-toggle" href="index.html">
                                    Home
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="demo-shop-1.html" data-thumb-preview="<?=Yii::getAlias('@web')?>/template/img/demos/shop/previews/home1.jpg">Home All</a></li>
                                            <li><a href="index-2.html" data-thumb-preview="<?=Yii::getAlias('@web')?>/template/img/demos/shop/previews/home2.jpg">Home Customer</a></li>
                                            <li><a href="index-3.html" data-thumb-preview="<?=Yii::getAlias('@web')?>/template/img/demos/shop/previews/home3.jpg">Home Agen</a></li>
                                </ul>
                            </li>
                            
                            <li class="dropdown dropdown-mega">
                                <a href="demo-shop-4-category-4col.html" class="dropdown-toggle">
                                    Kategori
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="dropdown-mega-content">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="dropdown-mega-top">
                                                        <span>Suggestions:</span>
                                                        <a href="demo-shop-4-category-4col.html">Mata Bor</a>
                                                        <a href="demo-shop-4-category-4col.html">Mesin Bor</a>
                                                        <a href="demo-shop-4-category-4col.html">Angkur</a>
                                                        <a href="demo-shop-4-category-4col.html">Gergaji</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <a href="#" class="cat-img"><img src="<?=Yii::getAlias('@web')?>/template/img/demos/shop/cat-tv.png" alt="Category Name"></a>
                                                            
                                                            <a href="#" class="dropdown-mega-sub-title">Peralatan Kayu</a>
                                                            <ul class="dropdown-mega-sub-nav">
                                                                <li><a href="demo-shop-4-category-4col.html">Jig Saw</a></li>
                                                                <li><a href="demo-shop-4-category-4col.html">Bor &amp; Mata Bor</a></li>
                                                                <li><a href="demo-shop-4-category-4col.html">Pasrah Kayu</a></li>
                                                                <li><a href="demo-shop-4-category-4col.html">Mur</a></li>
                                                                <li><a href="demo-shop-4-category-4col.html">Obeng</a></li>
                                                                <li><a href="demo-shop-4-category-4col.html">Tatah Kayu</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <a href="demo-shop-4-category-4col.html" class="cat-img"><img src="<?=Yii::getAlias('@web')?>/template/img/demos/shop/cat-camera.png" alt="Category Name"></a>
                                                            <a href="demo-shop-4-category-4col.html" class="dropdown-mega-sub-title">Peralatan Beton</a>
                                                            <ul class="dropdown-mega-sub-nav">
                                                                <li><a href="demo-shop-4-category-4col.html">Peralatan Beton 1</a></li>
                                                                <li><a href="demo-shop-4-category-4col.html">Peralatan Beton 2</a></li>
                                                                <li><a href="demo-shop-4-category-4col.html">Peralatan Beton 3</a></li>
                                                                <li><a href="demo-shop-4-category-4col.html">Peralatan Beton 4</a></li>
                                                                <li><a href="demo-shop-4-category-4col.html">Peralatan Beton 5</a></li>
                                                                <li><a href="demo-shop-4-category-4col.html">Peralatan Beton 6</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <a href="demo-shop-4-category-4col.html" class="cat-img"><img src="<?=Yii::getAlias('@web')?>/template/img/demos/shop/cat-game.png" alt="Category Name"></a>
                                                            <a href="demo-shop-4-category-4col.html" class="dropdown-mega-sub-title">Konstruksi Jalan</a>
                                                            <ul class="dropdown-mega-sub-nav">
                                                                <li><a href="demo-shop-4-category-4col.html">Peralatan 1</a></li>
                                                                <li><a href="demo-shop-4-category-4col.html">Peralatan 2</a></li>
                                                                <li><a href="demo-shop-4-category-4col.html">Peralatan 3</a></li>
                                                                <li><a href="demo-shop-4-category-4col.html">Peralatan 4</a></li>
                                                                <li><a href="demo-shop-4-category-4col.html">Peralatan 5</a></li>
                                                                <li><a href="demo-shop-4-category-4col.html">Peralatan 6</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="menu-banner-area">
                                                        <img src="<?=Yii::getAlias('@web')?>/template/img/demos/shop/menu-cat.png" alt="Menu Banner">
                                                        <div class="menu-banner-header">
                                                            <h3>Promo <span class="font-weight-extra-bold">Mesin Bor</span></h3>
                                                            <a href="#" class="btn btn-primary">View now <i class="fa fa-caret-right"></i></a>
                                                        </div>
                                                        <p>This is a custom block. You can add any images or links here</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle">
                                    Panduan
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="demo-shop-4-blog.html">Panduan</a></li>
                                    <li><a href="demo-shop-4-blog-post.html">Panduan Detail</a></li>
                                </ul>
                            </li>
                            <li class="pull-right">
                                <a href="demo-shop-4-contact-us.html">
                                    Contact Us <span class="tip tip-hot">Hot!</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>