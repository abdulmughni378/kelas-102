<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .form-group{
        margin-bottom: 5px;
    }
</style>
<div class="site-reset-password">
    <div id="mobile-menu-overlay"></div>

        <div role="main" class="main">
            
        <section class="form-section reset-form">
            <div class="container">
                <h1 class="h2 heading-primary font-weight-normal mb-md mt-lg">Reset Password</h1>

                <div class="featured-box featured-box-primary featured-box-flat featured-box-text-left mt-md">
                    <p>* Please choose your new password:</p>
                    <div class="box-content">
                        <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="font-weight-normal">Password <span class="required">*</span></label>
                                    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true])->label(false) ?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="font-weight-normal">Confirm Password <span class="required">*</span></label>
                                    <?= $form->field($model, 'password_confirm')->passwordInput(['autofocus' => true])->label(false) ?>
                                </div>
                            </div>

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
