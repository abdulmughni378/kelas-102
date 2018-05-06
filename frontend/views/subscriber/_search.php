<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SubscriberSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subscriber-search">

    <?php $form = ActiveForm::begin([
        'action' => ['/subscriber/create'],
        'method' => 'post',
    ]); ?>

    <?php /* 
    <?= $form->field($model, 'id') ?>


    <?= $form->field($model, 'created_date') ?>

    <?= $form->field($model, 'updated_date') ?>
    */ ?>
    
    <?php //echo $form->field($model, 'email') ?>

    <!-- <div class="form-group">
        <?php //echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div> -->

    <div class="input-group">
        <input class="form-control" placeholder="Email Address" name="Subscriber[email]" id="subscriber-email" type="text">
        <?php //echo $form->field($model, 'email')->textInput(['placeholder'=>"Email Address"])->label(false) ?>
        <span class="input-group-btn">
            <?php echo Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            <!-- <button class="btn btn-primary" type="submit">Submit</button> -->
        </span>
    </div>

    <?php ActiveForm::end(); ?>

</div>
