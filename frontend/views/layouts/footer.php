<?php  

use yii\helpers\Html;
use common\components\Content;
use common\models\Subscriber;
use yii\widgets\ActiveForm;

?>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <h4>Blibor</h4>
            <ul class="links">
                <li>
                    <i class="fa fa-caret-right text-color-primary"></i>
                    <a href="demo-shop-4-about-us.html">Tentang Blibor</a>
                </li>
                <li>
                    <i class="fa fa-caret-right text-color-primary"></i>
                    <a href="demo-shop-4-contact-us.html">Aturan Penggunaan</a>
                </li>
                <li>
                    <i class="fa fa-caret-right text-color-primary"></i>
                    <a href="demo-shop-4-myaccount.html">Kebijakan Privasi</a>
                </li>
                <li>
                    <i class="fa fa-caret-right text-color-primary"></i>
                    <a href="#">Daftar Sebagai Agen</a>
                </li>
                <li>
                    <i class="fa fa-caret-right text-color-primary"></i>
                    <a href="#">Advanced search</a>
                </li>
            </ul>
        </div>
        <div class="col-md-2">
            <h4>Pembeli</h4>
            <ul class="links">
                <li>
                    <i class="fa fa-caret-right text-color-primary"></i>
                    <a href="demo-shop-4-about-us.html">Cara Belanja</a>
                </li>
                <li>
                    <i class="fa fa-caret-right text-color-primary"></i>
                    <a href="demo-shop-4-contact-us.html">Pembayaran</a>
                </li>
                <li>
                    <i class="fa fa-caret-right text-color-primary"></i>
                    <a href="demo-shop-4-myaccount.html">Jaminan Aman</a>
                </li>
                <li>
                    <i class="fa fa-caret-right text-color-primary"></i>
                    <a href="#">Tips Belanja</a>
                </li>
                <li>
                    <i class="fa fa-caret-right text-color-primary"></i>
                    <a href="#">Produk Terkini</a>
                </li>
            </ul>
        </div>
        <div class="col-md-2">
            <div class="contact-details">
                <h4>Kontak Kami</h4>
                <ul class="contact">

                    <?php $kontakKami = Content::kontakKami(); ?>

                    <li><p><i class="fa fa-map-marker"></i> <strong>Address:</strong><br> <?= $kontakKami->address; ?></p></li>
                    <li><p><i class="fa fa-phone"></i> <strong>Phone:</strong><br> (+62) <?= $kontakKami->phone; ?></p></li>
                    <li><p><i class="fa fa-envelope-o"></i> <strong>Email:</strong><br> <a href="mailto:<?= $kontakKami->email; ?>"><?= $kontakKami->email; ?></a></p></li>
                    <li><p><i class="fa fa-clock-o"></i> <strong>Working Days/Hours:</strong><br><?= $kontakKami->working_days; ?></p></li>
                </ul>
            </div>
        </div>
        <div class="col-md-2">
            <h4>Edukasi</h4>
            <ul class="features">
                <li>
                    <i class="fa fa-check text-color-primary"></i>
                    <a href="#">Pengangkatan Facades</a>
                </li>
                <li>
                    <i class="fa fa-check text-color-primary"></i>
                    <a href="#">Pemasangan Angkur</a>
                </li>
                <li>
                    <i class="fa fa-check text-color-primary"></i>
                    <a href="#">Pasang Backing Rod &amp; Sealant</a>
                </li>
                <li>
                    <i class="fa fa-check text-color-primary"></i>
                    <a href="#">Tes Tarik</a>
                </li>
                <li>
                    <i class="fa fa-check text-color-primary"></i>
                    <a href="#">Mobile &amp; Retina Optimized</a>
                </li>
            </ul>
        </div>
        <div class="col-md-2">
            <div class="newsletter">
                <h4>Be the First to Know</h4>
                <p class="newsletter-info">Get all the latest information on Events,<br> Sales and Offers. Sign up for newsletter today.</p>

                <div class="alert alert-success hidden" id="newsletterSuccess">
                    <strong>Success!</strong> You've been added to our email list.
                </div>

                <div class="alert alert-danger hidden" id="newsletterError"></div>


                <p>Enter your e-mail Address:</p>
                <!-- <form id="newsletterForm" action="php/newsletter-subscribe.php" method="POST">
                    <div class="input-group">
                        <input class="form-control" placeholder="Email Address" name="newsletterEmail" id="newsletterEmail" type="text">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </span>
                    </div>
                </form> -->
                <?php echo $this->render('/subscriber/_search', ['model' => new Subscriber()]); ?>
            </div>
        </div>
    </div>
</div>