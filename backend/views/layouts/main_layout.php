<?php
if ( Yii::$app->user->isGuest )
    return Yii::$app->controller->redirect('/login');
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Administrator | Blibor</title>
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Blibor - Penyedia Peralatan Konstruksi">
    <meta name="author" content="IOMedia Indonesia">

    <!-- Favicon -->
    <link rel="shortcut icon" href="/admin_lte/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/admin_lte/apple-touch-icon.png">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <?php $this->head() ?>

</head>
<!-- <body> -->
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">

    <?php echo Yii::$app->controller->renderPartial('@backend/views/layouts/main_header');?>
    <?php echo Yii::$app->controller->renderPartial('@backend/views/layouts/main_menu_kiri');?>
  

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- /.content -->
        <?= $content; ?>
    </div>
    <!-- /.content-wrapper -->
    
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights reserved.
    </footer>

      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <!-- <div class="control-sidebar-bg"></div> -->
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="/admin_lte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script src="/admin_lte/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script>
  $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
    });
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
