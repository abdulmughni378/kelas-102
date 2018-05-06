<?php
use common\components\GuideHelper;
use yii\helpers\Url;
use common\components\Helper;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<?php 
    $helper = new GuideHelper();
?>
<div class="site-index">

    <div class="container">
        <div class="info-bar">
            <div class="row">
                <div class="col-md-6">
                    <i class="fa fa-user-circle-o bar-icon"></i>
                    <div class="bar-textarea">
                        <h3>Daftar Sebagai Pelanggan <small><a href="#">disini</a></small></h3>
                        <!-- <p>Dapatkan penawaran gratis dari kami. <a href="#">Daftar</a></p> -->
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <i class="fa fa-money bar-icon"></i>
                    <div class="bar-textarea">
                        <h3>Daftar Sebagai Agen <small><a href="#">disini</a></small></h3>
                        <!-- <p>Dapatkan komisi super extra dari kami. <a href="#">Daftar</a></p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="banners-container banner-parent">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <div class="banner">
                        <a href="#"><img src="<?=Yii::getAlias('@web')?>/template/img/sample/banner/banner1.jpg" alt="Banner" class="v1"></a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="banner">
                        <a href="#"><img src="<?=Yii::getAlias('@web')?>/template/img/sample/banner/banner2.jpg" alt="Banner"></a>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="banner">
                                <a href="#"><img src="<?=Yii::getAlias('@web')?>/template/img/sample/banner/banner3.jpg" alt="Banner" class="v3"></a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="banner">
                                <a href="#"><img src="<?=Yii::getAlias('@web')?>/template/img/sample/banner/banner3.jpg" alt="Banner" class="v3"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="banner">
                        <a href="#"><img src="<?=Yii::getAlias('@web')?>/template/img/sample/banner/banner4.jpg" alt="Banner" class="v1"></a>
                    </div>
                </div>
                
            </div>
        </div>
    </div> 

    <div class="container mb-xlg">
        <h2 class="slider-title">
            <span class="inline-title">Kategori</span>
        </h2>
        <div class="categories-grid columns8">

            <?php /*
            <?php foreach ($helper->getProductCategory() as $key => $value) : ?>

                <?php $img = (!empty($value->productImageCategory->image_url)) ? Yii::getAlias('@web') . $value->productImageCategory->image_url : ''; ?>             
                <li>
                    <div class="categories">
                        <a href="#" title="<?php echo $value->productType->description ?>" class="brand-image-area">
                            <img class="img-responsive" src="<?= $img ?>" alt="Brand">
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>
            
            */ ?>


            <!-- fase 2 -->
            <?php foreach ($helper->getProductCategoryNew() as $key => $value) : ?>

                <?php $img = (!empty($value->image_thumbnail)) ? Yii::getAlias('@web') . $value->image_thumbnail : 'uploads/img/no-image.png'; ?>             
                <li>
                    <div class="categories">
                        <a href="#" title="<?php echo $value->description ?>" class="brand-image-area">
                            <img class="img-responsive" src="<?= $img ?>" alt="Brand">
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>
            <!-- end -->

            <!-- <li>
                <div class="brand">
                    <a href="#" title="Brand Name" class="brand-image-area">
                        <img class="img-responsive" src="<?= Yii::getAlias('@web')?>/template/img/sample/brands/square/brand1.jpg" alt="Brand">
                    </a>
                </div>
            </li>
            <li>
                <div class="brand">
                    <a href="#" title="Brand Name" class="brand-image-area">
                        <img class="img-responsive" src="<?=Yii::getAlias('@web')?>/template/img/sample/brands/square/brand1.jpg" alt="Brand">
                    </a>
                </div>
            </li>
            <li>
                <div class="brand">
                    <a href="#" title="Brand Name" class="brand-image-area">
                        <img class="img-responsive" src="<?=Yii::getAlias('@web')?>/template/img/sample/brands/square/brand1.jpg" alt="Brand">
                    </a>
                </div>
            </li>
            <li>
                <div class="brand">
                    <a href="#" title="Brand Name" class="brand-image-area">
                        <img class="img-responsive" src="<?=Yii::getAlias('@web')?>/template/img/sample/brands/square/brand1.jpg" alt="Brand">
                    </a>
                </div>
            </li>
            <li>
                <div class="brand">
                    <a href="#" title="Brand Name" class="brand-image-area">
                        <img class="img-responsive" src="<?=Yii::getAlias('@web')?>/template/img/sample/brands/square/brand1.jpg" alt="Brand">
                    </a>
                </div>
            </li>
            <li>
                <div class="brand">
                    <a href="#" title="Brand Name" class="brand-image-area">
                        <img class="img-responsive" src="<?=Yii::getAlias('@web')?>/template/img/sample/brands/square/brand1.jpg" alt="Brand">
                    </a>
                </div>
            </li>
            <li>
                <div class="brand">
                    <a href="#" title="Brand Name" class="brand-image-area">
                        <img class="img-responsive" src="<?=Yii::getAlias('@web')?>/template/img/sample/brands/square/brand1.jpg" alt="Brand">
                    </a>
                </div>
            </li> -->
        </div>
    </div>

    <div class="container mb-xlg">
        <h1 class="slider-title">
            <span class="inline-title">Apa Pekerjaan Yang Anda Lakukan?</span>
        </h1>
    </div>

    <div class="container mb-xlg">
        <h2 class="slider-title">
            <span class="inline-title">Pekerjaan Bangunan Gedung Atas</span>
            <span class="line"></span>
        </h2>

        <div class="owl-carousel owl-theme manual new-products-carousel">

            <?php foreach ($helper->getGuideCategoryGedungAtas() as $key => $value) : ?>
                <div class="product">
                    <figure class="product-image-area">
                         <a title="<?= $value->guide_category_name?> " class="product-image" href="<?= Url::to(['/guide/index', 'slug' => $value->slug])?>">
                             <img src="<?=Yii::getAlias('@web').'/'.$value->image?>" alt="Product Name">
                         </a>
                    </figure>
                    <div class="product-details-area">
                        <h2 class="product-name"><a href="<?= Url::to(['/guide/index', 'slug' => $value->slug])?>" title="<?=$value->guide_category_name?>"><?=$value->guide_category_name?></a></h2>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- <div class="product">
                <figure class="product-image-area">
                    <a href="demo-shop-4-product-details.html" title="Product Name" class="product-image">
                        <img src="<?=Yii::getAlias('@web')?>/template/img/sample/guide/Pekerjaan_Struktur_Beton_Atas-01.png" alt="Product Name">
                    </a>
                </figure>
                <div class="product-details-area">
                    <h2 class="product-name"><a href="pekerjaan-struktur-beton-atas.html" title="Product Name">Pekerjaan Struktur Beton Atas</a></h2>
                </div>
            </div> -->

           <!--  <div class="product">
                <figure class="product-image-area">
                    <a href="demo-shop-4-product-details.html" title="Product Name" class="product-image">
                        <img src="<?=Yii::getAlias('@web')?>/template/img/sample/guide/Pekerjaan_Facade-01.png" alt="Product Name">
                    </a>
                </figure>
                <div class="product-details-area">
                    <h2 class="product-name"><a href="pekerjaan-facades.html" title="Product Name">Pekerjaan Facades</a></h2>
                </div>
            </div>

            <div class="product">
                <figure class="product-image-area">
                    <a href="demo-shop-4-product-details.html" title="Product Name" class="product-image">
                        <img src="<?=Yii::getAlias('@web')?>/template/img/sample/guide/Pekerjaan_Mechanical-Electrical-Plumbing-01.png" alt="Product Name">
                    </a>
                </figure>
                <div class="product-details-area">
                    <h2 class="product-name"><a href="pekerjaan-mep.html" title="Product Name">Pekerjaan MEP</a></h2>
                </div>
            </div>

            <div class="product">
                <figure class="product-image-area">
                    <a href="demo-shop-4-product-details.html" title="Product Name" class="product-image">
                        <img src="<?=Yii::getAlias('@web')?>/template/img/sample/guide/Pekerjaan-Interior-01.png" alt="Product Name">
                    </a>
                </figure>
                <div class="product-details-area">
                    <h2 class="product-name"><a href="pekerjaan-interior.html" title="Product Name">Pekerjaan Interior</a></h2>
                </div>
            </div>

            <div class="product">
                <figure class="product-image-area">
                    <a href="demo-shop-4-product-details.html" title="Product Name" class="product-image">
                        <img src="<?=Yii::getAlias('@web')?>/template/img/sample/guide/Pekerjaan-Besi-Dan-Baja-01.png" alt="Product Name">
                    </a>
                </figure>
                <div class="product-details-area">
                    <h2 class="product-name"><a href="pekerjaan-besi-baja.html" title="Product Name">Pekerjaan Besi &amp; Baja</a></h2>
                </div>
            </div>

            <div class="product">
                <figure class="product-image-area">
                    <a href="demo-shop-4-product-details.html" title="Product Name" class="product-image">
                        <img src="<?=Yii::getAlias('@web')?>/template/img/sample/guide/Pekerjaan-Besi-Dan-Baja-01.png" alt="Product Name">
                    </a>
                </figure>
                <div class="product-details-area">
                    <h2 class="product-name"><a href="pekerjaan-besi-baja.html" title="Product Name">Pekerjaan Besi &amp; Baja</a></h2>
                </div>
            </div> -->
        </div>
    </div>

    <div class="container mb-xlg">
        <h2 class="slider-title">
            <span class="inline-title">Pekerjaan Bangunan Gedung Bawah</span>
            <span class="line"></span>
        </h2>

        <div class="owl-carousel owl-theme manual new-products-carousel">
            <?php foreach ($helper->getGuideCategoryGedungBawah() as $key => $value) : ?>
                <div class="product">
                    <figure class="product-image-area">
                         <a title="<?=$value->guide_category_name?>" class="product-image" href="<?= Url::to(['/guide/index', 'slug' => $value->slug])?>">
                             <img src="<?=Yii::getAlias('@web').'/'.$value->image?>" alt="Product Name">
                         </a>
                    </figure>
                    <div class="product-details-area">
                        <h2 class="product-name"><a href="<?= Url::to(['/guide/index', 'slug' => $value->slug])?>" title="<?=$value->guide_category_name?>"><?=$value->guide_category_name?></a></h2>
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- <div class="product">
                <figure class="product-image-area">
                    <a href="demo-shop-4-product-details.html" title="Product Name" class="product-image">
                        <img src="<?=Yii::getAlias('@web')?>/template/img/sample/guide/Pekerjaan-Galian-Timbunan-01.png" alt="Product Name">
                    </a>
                </figure>
                <div class="product-details-area">
                    <h2 class="product-name"><a href="pekerjaan-galian-timbunan.html" title="Product Name">Pekerjaan Galian/Timbunan</a></h2>
                </div>
            </div>

            <div class="product">
                <figure class="product-image-area">
                    <a href="demo-shop-4-product-details.html" title="Product Name" class="product-image">
                        <img src="<?=Yii::getAlias('@web')?>/template/img/sample/guide/PekerjaanFondasi-01.png" alt="Product Name">
                    </a>
                </figure>
                <div class="product-details-area">
                    <h2 class="product-name"><a href="pekerjaan-foundasi.html" title="Product Name">Pekerjaan Fondasi</a></h2>
                </div>
            </div> -->
        </div>
    </div>

    <div class="container mb-xlg">
        <h2 class="slider-title">
            <span class="inline-title">Infrastruktur Jalan &amp; Jembatan</span>
            <span class="line"></span>
        </h2>

        <div class="owl-carousel owl-theme manual new-products-carousel">
            <?php foreach ($helper->getGuideCategoryInfrastruktur() as $key => $value) : ?>
                <div class="product">
                    <figure class="product-image-area">
                         <a title="<?=$value->guide_category_name?>" class="product-image" href="<?= Url::to(['/guide/index', 'slug' => $value->slug])?>">
                             <img src="<?=Yii::getAlias('@web').'/'.$value->image?>" alt="Product Name">
                         </a>
                    </figure>
                    <div class="product-details-area">
                        <h2 class="product-name"><a href="<?= Url::to(['/guide/index', 'slug' => $value->slug])?>" title="<?=$value->guide_category_name?>"><?=$value->guide_category_name?></a></h2>
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- <div class="product">
                <figure class="product-image-area">
                    <a href="demo-shop-4-product-details.html" title="Product Name" class="product-image">
                        <img src="<?=Yii::getAlias('@web')?>/template/img/sample/guide/Pekerjaan-Pengukuran-01.png" alt="Product Name">
                    </a>
                </figure>
                <div class="product-details-area">
                    <h2 class="product-name"><a href="pekerjaan-pengukuran.html" title="Product Name">Pekerjaan Pengukuran</a></h2>
                </div>
            </div>

            <div class="product">
                <figure class="product-image-area">
                    <a href="demo-shop-4-product-details.html" title="Product Name" class="product-image">
                        <img src="<?=Yii::getAlias('@web')?>/template/img/sample/guide/pekerjaan_galian_timbunan.png" alt="Product Name">
                    </a>
                </figure>
                <div class="product-details-area">
                    <h2 class="product-name"><a href="pekerjaan-galian-timbunan.html" title="Product Name">Pekerjaan Galian &amp; Timbunan</a></h2>
                </div>
            </div>

            <div class="product">
                <figure class="product-image-area">
                    <a href="demo-shop-4-product-details.html" title="Product Name" class="product-image">
                        <img src="<?=Yii::getAlias('@web')?>/template/img/sample/guide/Pekerjaan-Pelat-Beton-Struktur-01.png" alt="Product Name">
                    </a>
                </figure>
                <div class="product-details-area">
                    <h2 class="product-name"><a href="pekerjaan-struktur-beton.html" title="Product Name">Pekerjaan Beton Struktur</a></h2>
                </div>
            </div> -->
        </div>
    </div>

   <!--  <div class="container mb-xlg">
        <h2 class="slider-title">
            <span class="inline-title">Apa Pekerjaan Yang Anda Lakukan?</span>
        </h2>

        <div class="row">
            <div class="col-sm-3">
                <img class="img-responsive" src="<?=Yii::getAlias('@web')?>/template/img/sample/banner/banner1.jpg" alt="Post">
            </div>
            <div class="col-sm-3">
                <h4>Pekerjaan Bangunan Atas</h4>
                    <ul class="nav nav-list">
                        <li><a href="page-left-sidebar.html">Pekerjaan Struktur Beton Atas</a></li>
                        <li><a href="page-left-sidebar.html">Pekerjaan Facades</a></li>
                        <li><a href="page-left-sidebar.html">Pekerjaan MEP</a></li>
                        <li><a href="page-left-sidebar.html">Pekerjaan Interior</a></li>
                        <li><a href="page-left-sidebar.html">Pekerjaan Besi &amp; Baja</a></li>
                    </ul>
            </div>

            <div class="col-sm-3">
                <h4>Pekerjaan bangunan Bawah</h4>
                    <ul class="nav nav-list">
                        <li><a href="page-left-sidebar.html">Pekerjaan Galian/Timbunan</a></li>
                        <li><a href="page-left-sidebar.html">Pekerjaan Fondasi</a></li>
                        <li><a href="page-left-sidebar.html">Pekerjaan Sloof</a></li>
                        <li><a href="page-left-sidebar.html">Pekerjaan Cor</a></li>
                    </ul>
            </div>

            <div class="col-sm-3">
                <h4>Infrastruktur Jalan &amp; Jembatan</h4>
                    <ul class="nav nav-list">
                        <li><a href="page-left-sidebar.html">Pekerjaan Pengukuran</a></li>
                        <li><a href="page-left-sidebar.html">Pekerjaan Galian &amp; Timbunan</a></li>
                        <li><a href="page-left-sidebar.html">Pekerjaan Beton Struktur</a></li>
                        <li><a href="page-left-sidebar.html">Pekerjaan Perancah</a></li>
                        <li><a href="page-left-sidebar.html">Pekerjaan Service Crane</a></li>
                    </ul>
            </div>
        </div>
    </div> -->

    <?php /* ?>

    <div class="container mb-lg">
        <h2 class="slider-title">
            <span class="inline-title">Barang Import Dengan Harga Murah</span>
        </h2>

        <div class="owl-carousel owl-theme manual new-products-carousel">

            <?php foreach ($helper->getProductTerpilih() as $key => $value) : ?>

                <?php $img = (!empty($value->productImageCategory->image_url)) ? Yii::getAlias('@web') . $value->productImageCategory->image_thumbnail : 'uploads/img/no-image.png'; ?>  
                
                <div class="product">
                    <figure class="product-image-area">
                        <a href="<?= Url::to(['/guide/product', 'slug' => $value->slug])?>" title="<?=$value->product_name?>" class="product-image">
                            <img src="<?=Yii::getAlias('@web').'/'.$img ?>" alt="Product Name" height="272" width="204">
                        </a>

<!--                         <a href="#" class="product-quickview">
                            <i class="fa fa-share-square-o"></i>
                            <span>Quick View</span>
                        </a>
                        <div class="product-label"><span class="discount">-10%</span></div>
                        <div class="product-label"><span class="new">New</span></div> -->
                    </figure>
                    <div class="product-details-area">
                        <h2 class="product-name"><a href="<?= Url::to(['/guide/product', 'slug' => $value->slug])?>" title="Product Name"><?=$value->product_name?></a></h2>
                       <!--  <div class="product-ratings">
                            <div class="ratings-box">
                                <div class="rating" style="width:60%"></div>
                            </div>
                        </div> -->

                        <div class="product-price-box">
                            <span class="old-price"><?= Helper::rupiahFormat($value->base_price); ?></span>
                            <span class="product-price"><?= Helper::rupiahFormat($value->productPublicPrice()); ?></span>
                        </div>
                        <?php $paramProduct = "Kami melakukan penawaran untuk product di bawah ini, ".Yii::$app->urlManager->createAbsoluteUrl([\yii\helpers\Url::previous()]);?>

                        <a href="http://google.com" class="btn btn-xs btn-primary"> Send Email</a>
                        <!-- <a href="https://api.whatsapp.com/send?phone=6285732345769&text=<?=$paramProduct?>" target="blank" class="btn btn-success"> Send WhatsApp</a> -->

                        <?php echo yii\helpers\Html::a('Send WhatsApp', 'https://api.whatsapp.com/send?phone='.Yii::$app->params['phone'].'&text='.$paramProduct, [
                            'target' => '_blank',
                            'class' => 'btn btn-xs btn-success',
                            'data' => [
                                'confirm' => 'Are you sure you want to send this product?',
                                // 'method' => 'get',
                            ],
                        ]) ?>

                        <!-- <div class="product-actions">
                            <a href="#" class="addtowishlist" title="Add to Wishlist">
                                <i class="fa fa-heart"></i>
                            </a>
                            <a href="#" class="addtocart" title="Add to Cart">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Add to Cart</span>
                            </a>
                            <a href="#" class="comparelink" title="Add to Compare">
                                <i class="glyphicon glyphicon-signal"></i>
                            </a>
                        </div> -->
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- <div class="product">
                <figure class="product-image-area">
                    <a href="demo-shop-4-product-details.html" title="Product Name" class="product-image">
                        <img src="<?=Yii::getAlias('@web')?>/template/img/demos/shop/products/shop4/product4.jpg" alt="Product Name">
                        <img src="<?=Yii::getAlias('@web')?>/template/img/demos/shop/products/shop4/product4-2.jpg" alt="Product Name" class="product-hover-image">
                    </a>

                    <a href="#" class="product-quickview">
                        <i class="fa fa-share-square-o"></i>
                        <span>Quick View</span>
                    </a>
                    <div class="product-label"><span class="discount">-25%</span></div>
                </figure>
                <div class="product-details-area">
                    <h2 class="product-name"><a href="demo-shop-4-product-details.html" title="Product Name">Samsung Phone-Grey</a></h2>
                    <div class="product-ratings">
                        <div class="ratings-box">
                            <div class="rating" style="width:0%"></div>
                        </div>
                    </div>

                    <div class="product-price-box">
                        <span class="old-price">$120.00</span>
                        <span class="product-price">$90.00</span>
                    </div>

                    <div class="product-actions">
                        <a href="#" class="addtowishlist" title="Add to Wishlist">
                            <i class="fa fa-heart"></i>
                        </a>
                        <a href="#" class="addtocart" title="Add to Cart">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Add to Cart</span>
                        </a>
                        <a href="#" class="comparelink" title="Add to Compare">
                            <i class="glyphicon glyphicon-signal"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="product">
                <figure class="product-image-area">
                    <a href="demo-shop-4-product-details.html" title="Product Name" class="product-image">
                        <img src="<?=Yii::getAlias('@web')?>/template/img/demos/shop/products/shop4/product3.jpg" alt="Product Name">
                    </a>

                    <a href="#" class="product-quickview">
                        <i class="fa fa-share-square-o"></i>
                        <span>Quick View</span>
                    </a>
                </figure>
                <div class="product-details-area">
                    <h2 class="product-name"><a href="demo-shop-4-product-details.html" title="Product Name">Samsung Galaxy 4G</a></h2>
                    <div class="product-ratings">
                        <div class="ratings-box">
                            <div class="rating" style="width:60%"></div>
                        </div>
                    </div>

                    <div class="product-price-box">
                        <span class="product-price">$70.00</span>
                    </div>

                    <div class="product-actions">
                        <a href="#" class="addtowishlist" title="Add to Wishlist">
                            <i class="fa fa-heart"></i>
                        </a>
                        <a href="#" class="addtocart" title="Add to Cart">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Add to Cart</span>
                        </a>
                        <a href="#" class="comparelink" title="Add to Compare">
                            <i class="glyphicon glyphicon-signal"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="product">
                <figure class="product-image-area">
                    <a href="demo-shop-4-product-details.html" title="Product Name" class="product-image">
                        <img src="<?=Yii::getAlias('@web')?>/template/img/demos/shop/products/shop4/product5.jpg" alt="Product Name">
                    </a>

                    <a href="#" class="product-quickview">
                        <i class="fa fa-share-square-o"></i>
                        <span>Quick View</span>
                    </a>
                    <div class="product-label"><span class="discount">-20%</span></div>
                </figure>
                <div class="product-details-area">
                    <h2 class="product-name"><a href="demo-shop-4-product-details.html" title="Product Name">Motorola Phone</a></h2>
                    <div class="product-ratings">
                        <div class="ratings-box">
                            <div class="rating" style="width:80%"></div>
                        </div>
                    </div>

                    <div class="product-price-box">
                        <span class="old-price">$100.00</span>
                        <span class="product-price">$90.00</span>
                    </div>

                    <div class="product-actions">
                        <a href="#" class="addtowishlist" title="Add to Wishlist">
                            <i class="fa fa-heart"></i>
                        </a>
                        <a href="#" class="addtocart" title="Add to Cart">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Add to Cart</span>
                        </a>
                        <a href="#" class="comparelink" title="Add to Compare">
                            <i class="glyphicon glyphicon-signal"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="product">
                <figure class="product-image-area">
                    <a href="demo-shop-4-product-details.html" title="Product Name" class="product-image">
                        <img src="<?=Yii::getAlias('@web')?>/template/img/demos/shop/products/shop4/product5.jpg" alt="Product Name">
                    </a>

                    <a href="#" class="product-quickview">
                        <i class="fa fa-share-square-o"></i>
                        <span>Quick View</span>
                    </a>
                </figure>
                <div class="product-details-area">
                    <h2 class="product-name"><a href="demo-shop-4-product-details.html" title="Product Name">Samsung Phone</a></h2>
                    <div class="product-ratings">
                        <div class="ratings-box">
                            <div class="rating" style="width:0%"></div>
                        </div>
                    </div>

                    <div class="product-price-box">
                        <span class="product-price">$70.00</span>
                    </div>

                    <div class="product-actions">
                        <a href="#" class="addtowishlist" title="Add to Wishlist">
                            <i class="fa fa-heart"></i>
                        </a>
                        <a href="#" class="addtocart" title="Add to Cart">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Add to Cart</span>
                        </a>
                        <a href="#" class="comparelink" title="Add to Compare">
                            <i class="glyphicon glyphicon-signal"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="product">
                <figure class="product-image-area">
                    <a href="demo-shop-4-product-details.html" title="Product Name" class="product-image">
                        <img src="<?=Yii::getAlias('@web')?>/template/img/demos/shop/products/shop4/product1.jpg" alt="Product Name">
                    </a>

                    <a href="#" class="product-quickview">
                        <i class="fa fa-share-square-o"></i>
                        <span>Quick View</span>
                    </a>
                    <div class="product-label"><span class="new">New</span></div>
                </figure>
                <div class="product-details-area">
                    <h2 class="product-name"><a href="demo-shop-4-product-details.html" title="Product Name">Samsung Galaxy-White</a></h2>
                    <div class="product-ratings">
                        <div class="ratings-box">
                            <div class="rating" style="width:80%"></div>
                        </div>
                    </div>

                    <div class="product-price-box">
                        <span class="product-price">$80.00</span>
                    </div>

                    <div class="product-actions">
                        <a href="#" class="addtowishlist" title="Add to Wishlist">
                            <i class="fa fa-heart"></i>
                        </a>
                        <a href="#" class="addtocart" title="Add to Cart">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Add to Cart</span>
                        </a>
                        <a href="#" class="comparelink" title="Add to Compare">
                            <i class="glyphicon glyphicon-signal"></i>
                        </a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

    <?php */ ?>

    <!-- BRAND -->
    <div class="container mb-xlg">
        <h2 class="slider-title">
            <span class="inline-title">Brands</span>
        </h2>

        <ul class="brand-grid columns8">

            <?php foreach ($helper->getBrand() as $key => $value) : ?>
                <?php $img = (!empty($value->brand_image)) ? Yii::getAlias('@web') . $value->brand_image : 'uploads/img/no-image.png'; ?>   
                <li>
                    <div class="brand">
                        <a href="#" title="<?=$value->brand_name?>" class="brand-image-area">
                            <img class="img-responsive" src="<?= $img; ?>" alt="Brand">
                        </a>
                    </div>
                </li>

            <?php endforeach; ?>

            <!-- <li>
                <div class="brand">
                    <a href="#" title="Brand Name" class="brand-image-area">
                        <img class="img-responsive" src="<?=Yii::getAlias('@web')?>/template/img/sample/brands/square/brand1.jpg" alt="Brand">
                    </a>
                </div>
            </li>
            <li>
                <div class="brand">
                    <a href="#" title="Brand Name" class="brand-image-area">
                        <img class="img-responsive" src="<?=Yii::getAlias('@web')?>/template/img/sample/brands/square/brand1.jpg" alt="Brand">
                    </a>
                </div>
            </li>
            <li>
                <div class="brand">
                    <a href="#" title="Brand Name" class="brand-image-area">
                        <img class="img-responsive" src="<?=Yii::getAlias('@web')?>/template/img/sample/brands/square/brand1.jpg" alt="Brand">
                    </a>
                </div>
            </li>
            <li>
                <div class="brand">
                    <a href="#" title="Brand Name" class="brand-image-area">
                        <img class="img-responsive" src="<?=Yii::getAlias('@web')?>/template/img/sample/brands/square/brand1.jpg" alt="Brand">
                    </a>
                </div>
            </li>
            <li>
                <div class="brand">
                    <a href="#" title="Brand Name" class="brand-image-area">
                        <img class="img-responsive" src="<?=Yii::getAlias('@web')?>/template/img/sample/brands/square/brand1.jpg" alt="Brand">
                    </a>
                </div>
            </li>
            <li>
                <div class="brand">
                    <a href="#" title="Brand Name" class="brand-image-area">
                        <img class="img-responsive" src="<?=Yii::getAlias('@web')?>/template/img/sample/brands/square/brand1.jpg" alt="Brand">
                    </a>
                </div>
            </li>
            <li>
                <div class="brand">
                    <a href="#" title="Brand Name" class="brand-image-area">
                        <img class="img-responsive" src="<?=Yii::getAlias('@web')?>/template/img/sample/brands/square/brand1.jpg" alt="Brand">
                    </a>
                </div>
            </li> -->
        </ul>
    </div>
</div>
