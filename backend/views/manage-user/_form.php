<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2',
                    // 'offset' => 'col-sm-offset-9',
                    'wrapper' => 'col-sm-6',
                    'error' => '',
                    'hint' => '',
                ], 
            ],
        ]); ?>

    <?= $form->field($model, 'is_type')->dropDownList(
        $model->userType(),
        [
            'prompt'      => 'Select User Type',
            'class'       => 'form-control select2',
        ]
        )->label('User Type*'); ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true])->label('Full Name*') ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true])->label('Username*') ?>
    
    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label('Email*') ?>
    
    <?= $form->field($model, 'gender')->inline()->radioList(['1' => 'Male', '0' => 'Female']); ?>

    <?= $form->field($model, 'birth_date')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter birth date'],
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose'=>true
            ],
            'size' => 'md',
        ]);
    ?>    

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true])->label('Phone Number*') ?>


    <?php if(!$model->isNewRecord):?>

        <div class="form-group">
            <label class="control-label col-sm-2">Current Image</label>
            <div class="col-sm-3">
            <?php 
                $noImage = 'uploads/img/no-image.png';
                $img = Yii::$app->params['front'].(empty($model->picture) ? $noImage : $model->picture); 
            ?>

            <?php echo Html::img($img, ['width'=>'150']);?>
            </div>
        </div>
    <?php endif; ?>

    <?= $form->field($model, 'file')->fileInput(['accept' => 'image/*']); ?>

    <?= $form->field($model, 'password')->passwordInput(['value'=>''])->label('Password*') ?>

    <?= $form->field($model, 'password_confirm')->passwordInput(['value'=>''])->label('Password Confirm*') ?>

    <div class="form-group">
        <label class="control-label col-sm-2"></label>
        <div class="col-sm-3">
            <?= Html::a('<span class="btn-label"><i class="glyphicon glyphicon-chevron-left"></i></span>Cancel', 
                ['/manage-user'], 
                [
                    'class' => 'btn btn-labeled btn-info m-b-5 pull-left', 
                    'title' => 'Cancel'
                ]) ?>&nbsp;
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
