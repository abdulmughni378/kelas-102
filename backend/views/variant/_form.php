<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use common\models\ProductType;
use common\models\Brand;

/* @var $this yii\web\View */
/* @var $model common\models\Variant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="variant-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2',
                    // 'offset' => 'col-sm-offset-9',
                    'wrapper' => 'col-sm-5',
                    'error' => '',
                    'hint' => '',
                ], 
            ],
        ]); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <label class="control-label col-sm-2"></label>
        <div class="col-sm-3">
            <?= Html::a('<span class="btn-label"><i class="glyphicon glyphicon-chevron-left"></i></span>Cancel', 
                ['/variant'], 
                [
                    'class' => 'btn btn-labeled btn-info m-b-5 pull-left', 
                    'title' => 'Cancel'
                ]) ?>&nbsp;
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

