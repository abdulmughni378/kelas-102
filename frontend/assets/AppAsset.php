<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

        // Vendor CSS
        "template/vendor/bootstrap/css/bootstrap.min.css",
        "template/vendor/font-awesome/css/font-awesome.min.css",
        "template/vendor/animate/animate.min.css",
        "template/vendor/simple-line-icons/css/simple-line-icons.min.css",
        "template/vendor/owl.carousel/assets/owl.carousel.min.css",
        "template/vendor/owl.carousel/assets/owl.theme.default.min.css",
        "template/vendor/magnific-popup/magnific-popup.min.css",

        // <!-- Theme CSS -->
        "template/css/theme.css",
        "template/css/theme-elements.css",
        "template/css/theme-blog.css",
        "template/css/theme-shop.css",

        // <!-- Current Page CSS -->
        "template/vendor/rs-plugin/css/settings.css",
        "template/vendor/rs-plugin/css/layers.css",
        "template/vendor/rs-plugin/css/navigation.css",

        // <!-- Skin CSS -->
        "template/css/skins/skin-shop-4.css",

        // <!-- Demo CSS -->
        "template/css/demos/demo-shop-4.css",
        

        // <!-- Theme Custom CSS -->
        "template/css/custom.css",
        // 'css/site.css',
    ];
    public $js = [
        // <!-- Vendor -->
        // "template/vendor/jquery/jquery.min.js",
        "template/vendor/jquery.appear/jquery.appear.min.js",
        "template/vendor/jquery.easing/jquery.easing.min.js",
        "template/vendor/jquery-cookie/jquery-cookie.min.js",
        "template/vendor/bootstrap/js/bootstrap.min.js",
        "template/vendor/common/common.min.js",
        "template/vendor/jquery.validation/jquery.validation.min.js",
        "template/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js",
        "template/vendor/jquery.gmap/jquery.gmap.min.js",
        "template/vendor/jquery.lazyload/jquery.lazyload.min.js",
        "template/vendor/isotope/jquery.isotope.min.js",
        "template/vendor/owl.carousel/owl.carousel.min.js",
        "template/vendor/magnific-popup/jquery.magnific-popup.min.js",
        "template/vendor/vide/vide.min.js",
        
        // <!-- Theme Base, Components and Settings -->
        "template/js/theme.js",


        "template/vendor/rs-plugin/js/jquery.themepunch.tools.min.js",
        "template/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js",

        // <!-- Current Page Vendor and Views -->
        "template/js/views/view.contact.js",

        "template/vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.js",
        "template/vendor/elevatezoom/jquery.elevatezoom.js",

        // <!-- Demo -->
        "template/js/demos/demo-shop-4.js",
        
        // <!-- Theme Custom -->
        "template/js/custom.js",
        
        // <!-- Theme Initialization Files -->
        "template/js/theme.init.js",

        // "/template/vendor/modernizr/modernizr.min.js"
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
