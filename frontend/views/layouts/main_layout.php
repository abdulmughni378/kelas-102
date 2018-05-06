<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
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
    <!-- <title><?= Html::encode($this->title) ?></title> -->
    <title>Blibor | Gorsir Peralatan Konstruksi</title>
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Blibor - Penyedia Peralatan Konstruksi">
    <meta name="author" content="IOMedia Indonesia">

    <!-- Favicon -->
    <link rel="shortcut icon" href="template/img/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="template/img/apple-touch-icon.png">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php echo Yii::$app->controller->renderPartial('@frontend/views/layouts/main_header');?>

    <?php //echo  $content; ?>
    <div class="container">
        <?= Alert::widget() ?>
    </div>

    <!-- <div class="container">
        <div class="info-bar">
            <div class="row">
                <div class="col-md-6">
                    <i class="fa fa-user-circle-o bar-icon"></i>
                    <div class="bar-textarea">
                        <h3>Daftar Sebagai Kustomer</h3>
                        <p>Dapatkan penawaran gratis dari kami. <a href="#">Daftar</a></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <i class="fa fa-money bar-icon"></i>
                    <div class="bar-textarea">
                        <h3>Daftar Sebagai Agen</h3>
                        <p>Dapatkan komisi super extra dari kami. <a href="#">Daftar</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <?= $content; ?>

</div>
<footer id="footer">
    
    <?php echo Yii::$app->controller->renderPartial('@frontend/views/layouts/footer');?>
    
    <?php echo Yii::$app->controller->renderPartial('@frontend/views/layouts/footer_copyright');?>
    
</footer>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>