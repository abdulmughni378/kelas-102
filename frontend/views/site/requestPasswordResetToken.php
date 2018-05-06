<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">
    <!-- <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out your email. A link to reset password will be sent there.</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div> -->
    <div id="mobile-menu-overlay"></div>

        <div role="main" class="main">
            
        <section class="form-section register-form">
            <div class="container">
                <h1 class="h2 heading-primary font-weight-normal mb-md mt-lg">Forgot your password ?</h1>

                <div class="featured-box featured-box-primary featured-box-flat featured-box-text-left mt-md">
                    <p>* Please fill out your email. A link to reset password will be sent there.</p>
                    <div class="box-content">
                        <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                            <label class="font-weight-normal">Email <span class="required">*</span></label>
                            <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label(false); ?>

                            <div class="form-group">
                                <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                            </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

