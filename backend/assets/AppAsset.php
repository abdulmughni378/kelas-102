<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "admin_lte/bower_components/bootstrap/dist/css/bootstrap.min.css",
        // <!-- Font Awesome -->
        "admin_lte/bower_components/font-awesome/css/font-awesome.min.css",
        // <!-- Ionicons -->
        "admin_lte/bower_components/Ionicons/css/ionicons.min.css",
        // <!-- Select2 -->
        "admin_lte/bower_components/select2/dist/css/select2.min.css",
        // <!-- Theme style -->
        "admin_lte/dist/css/AdminLTE.min.css",
        // <!-- AdminLTE Skins. Choose a skin from the css/skins
        //    folder instead of downloading all of them to reduce the load. -->
        "admin_lte/dist/css/skins/_all-skins.min.css",
        // <!-- Morris chart -->
        // "admin_lte/bower_components/morris.js/morris.css",
        // <!-- jvectormap -->
        // "admin_lte/bower_components/jvectormap/jquery-jvectormap.css",
        // <!-- Date Picker -->
        "admin_lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css",
        // <!-- Daterange picker -->
        "admin_lte/bower_components/bootstrap-daterangepicker/daterangepicker.css",
        // <!-- bootstrap wysihtml5 - text editor -->
        "admin_lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css",
        // 'css/site.css',
        'css/custom.css'
    ];
    public $js = [

        // <!-- jQuery 3 -->
        // "admin_lte/bower_components/jquery/dist/jquery.min.js",
        // <!-- jQuery UI 1.11.4 -->
        "admin_lte/bower_components/jquery-ui/jquery-ui.min.js",
        // <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        // <script>
        //   $.widget.bridge('uibutton', $.ui.button);
        // </script>
        // <!-- Bootstrap 3.3.7 -->
       "admin_lte/bower_components/bootstrap/dist/js/bootstrap.min.js",
       // <!-- Select2 -->
       "admin_lte/bower_components/select2/dist/js/select2.full.min.js",
       "admin_lte/bower_components/select2/dist/js/select2.min.js",
        // <!-- Morris.js charts -->
       // "admin_lte/bower_components/raphael/raphael.min.js",
       // "admin_lte/bower_components/morris.js/morris.min.js",
        // <!-- Sparkline -->
       "admin_lte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js",
        // <!-- jvectormap -->
       // "admin_lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js",
       // "admin_lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js",
        // <!-- jQuery Knob Chart -->
       // "admin_lte/bower_components/jquery-knob/dist/jquery.knob.min.js",
        // <!-- daterangepicker -->
       // "admin_lte/bower_components/moment/min/moment.min.js",
       "admin_lte/bower_components/bootstrap-daterangepicker/daterangepicker.js",
        // <!-- datepicker -->
       "admin_lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js",
        // <!-- Bootstrap WYSIHTML5 -->
       "admin_lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js",
        // <!-- Slimscroll -->
       "admin_lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js",
        // <!-- FastClick -->
       "admin_lte/bower_components/fastclick/lib/fastclick.js",
        // <!-- AdminLTE App -->
       "admin_lte/dist/js/adminlte.min.js",
        // <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
       // "admin_lte/dist/js/pages/dashboard.js",
        // <!-- AdminLTE for demo purposes -->
       // "admin_lte/dist/js/demo.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
