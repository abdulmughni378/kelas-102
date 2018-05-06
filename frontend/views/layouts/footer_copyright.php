<?php  
// use Yii;
use yii\helpers\Html;
use common\components\Content;

    $content = new Content();
    // echo '<pre>';
    // print_r($content->socialMedia());die();
?>
<style type="text/css">
    img {
        border-radius: 4px;
    }
</style>

<div class="footer-copyright">
    <div class="container">
        <a href="/" class="logo">
            <?= $content->footerLogo(); ?>
        </a>
    
        <ul class="social-icons">
            <?php foreach ($content->socialMedia() as $key => $soc) : ?>

                <?php 
                    $type = $soc->type;
                    $url  = $soc->url . $soc->name_account;
                ?>

                <li class="social-icons-<?= $type; ?>"><a href="http://<?=$url; ?>" target="_blank" title="<?= ucfirst($type);?>"><i class="fa fa-<?=$type;?>"></i></a></li>

            <?php endforeach; ?>
        </ul>

        <ul class="social-icons">
            <?php foreach ($content->paymentsIcon() as $key => $row) : ?>

                <?php 
                    $name = $row->name;
                    $url  = $content->baseUrlImage . $row->image_url;
                ?>

                <li class="">
                    <img alt="<?=$name;?>" src="<?= $url ?>" class="footer-payment"  style="width:28;height:26px;">
                </li>

            <?php endforeach; ?>

        </ul>
        <p class="copyright-text">© Copyright 2017. All Rights Reserved.</p>
    </div>
</div>