<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;

?>

<style type="text/css">
	.form-group{
		margin-bottom: 5px;
	}
</style>

<div id="mobile-menu-overlay"></div>

	<div role="main" class="main">
		
	<section class="form-section register-form">
		<div class="container">
			<h1 class="h2 heading-primary font-weight-normal mb-md mt-lg">Create an Account</h1>

			<div class="featured-box featured-box-primary featured-box-flat featured-box-text-left mt-md">
				<div class="box-content">
					<?php $form = ActiveForm::begin(['id' => 'form-register']); ?>

						<h4 class="heading-primary text-uppercase mb-lg">PERSONAL INFORMATION</h4>
						<div class="row">

							<div class="col-sm-4 col-md-4">
								<div class="form-group">
									<label class="font-weight-normal">Fullname <span class="required">*</span></label>
									<!-- <input type="text" class="form-control" required> -->
					                <?= $form->field($model, 'fullname')->textInput(['autofocus' => true])->label(false) ?>
								</div>
							</div>

							<div class="col-sm-4 col-md-4">
								<div class="form-group">
									<label class="font-weight-normal">Username <span class="required">*</span></label>
									<!-- <input type="text" class="form-control" required> -->
					                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(false) ?>
								</div>
							</div>

							<div class="col-sm-4 col-md-4">
								<div class="form-group">
									<label class="font-weight-normal">Phone Number <span class="required">*</span></label>
									<!-- <input type="text" class="form-control" required> -->
					                <?= $form->field($model, 'phone_number')->label(false); ?>
								</div>
							</div>

						</div>

						<div class="row">
							<div class="col-sm-4">
								<div class="form-group">
									<label class="font-weight-normal">Email <span class="required">*</span></label>
									<!-- <input type="password" class="form-control" required> -->
					                <?= $form->field($model, 'email')->label(false) ?>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="form-group">
									<label class="font-weight-normal">Password <span class="required">*</span></label>
									<!-- <input type="password" class="form-control" required> -->
					                <?= $form->field($model, 'password')->passwordInput()->label(false) ?>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="form-group">
									<label class="font-weight-normal">Confirm Password <span class="required">*</span></label>
									<!-- <input type="password" class="form-control" required> -->
					                <?= $form->field($model, 'password_confirm')->passwordInput()->label(false) ?>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12">
								<p class="required mt-lg mb-none">* Required Fields</p>

								<div class="form-action clearfix mt-none">
									<a href="demo-shop-4-login.html" class="pull-left"><i class="fa fa-angle-double-left"></i> Back</a>

									<!-- <input type="submit" class="btn btn-primary" value="Submit"> -->
									<?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
								</div>
							</div>
						</div>
				    <?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</section>
</div>