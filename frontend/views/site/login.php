<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

// use yii\helpers\Html;
// use yii\bootstrap\ActiveForm;

// $this->title = 'Login';
// $this->params['breadcrumbs'][] = $this->title;
?>
<!-- <div class="site-login"> -->
<?php echo /* 
    <!-- <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>
    <div class="row">
        <div class="col-lg-5">
            <?php //$form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div> -->
*/ " ";?>
<style type="text/css">
    .form-group{
        margin-bottom: 5px;
    }
</style>

    <div id="mobile-menu-overlay"></div>

    <div role="main" class="main">
        
    <section class="form-section">
        <div class="container">
            <h1 class="h2 heading-primary font-weight-normal mb-md mt-lg">Login or Create an Account</h1>

            <div class="featured-box featured-box-primary featured-box-flat featured-box-text-left mt-md">
                <div class="box-content">
                    <?php $form = ActiveForm::begin(['id' => 'form-login']); ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-content">
                                    <h3 class="heading-text-color font-weight-normal">New Customers</h3>
                                    <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                                </div>

                                <div class="form-action clearfix">
                                    <a href="/site/register" class="btn btn-primary">Create an Account</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-content">
                                    <h3 class="heading-text-color font-weight-normal">Registered Customers</h3>
                                    <p>If you have an account with us, please log in.</p>

                                    <div class="form-group">
                                        <label class="font-weight-normal">Username <span class="required">*</span></label>
                                        <?= $form->field($model, 'username')->label(false) ?>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-normal">Password <span class="required">*</span></label>
                                        <?= $form->field($model, 'password')->passwordInput()->label(false) ?>
                                    </div>

                                    <p class="required">* Required Fields</p>
                                </div>

                                <div class="form-action clearfix">
                                    <a href="/site/request-password-reset" class="pull-left">Forgot Your Password?</a>

                                    <!-- <input type="submit" class="btn btn-primary" value="Submit"> -->
                                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                                </div>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </section>

    </div>
<!-- </div> -->

