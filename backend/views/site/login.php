<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <div class="login-box">

        <div class="login-logo">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg text-center">Please fill out the following fields to login:</p>

                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <div class="form-group has-feedback">
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder'=>"Email"])->label(false) ?>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true, 'placeholder'=>"Password"])->label(false) ?>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="checkbox icheck">
                        <?= $form->field($model, 'rememberMe')->checkbox() ?> 
                    </div>
                    <!-- /.col -->
                <!-- /.col -->
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                    <!-- <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button> -->
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
