<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use common\models\Guide;

/* @var $this yii\web\View */
/* @var $model common\models\GuideCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guide-category-form">

    <?php //$form = ActiveForm::begin(); ?>
    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2',
                    // 'offset' => 'col-sm-offset-9',
                    'wrapper' => 'col-sm-4',
                    'error' => '',
                    'hint' => '',
                ], 
            ],
        ]); ?>

    <?php //echo $form->field($model, 'guide_category_id')->textInput() ?>

    <!-- <?= $form->field($model, 'guide_category_parent')->textInput() ?> -->
     <?= $form->field($model, 'guide_category_parent')->dropDownList(
        Guide::findAvailableCategory(),
        [
            'prompt'      => 'Select Category',
            'class'       => 'form-control select2',
            'placeholder' => '',
        ]
        ); ?>
    <?= $form->field($model, 'guide_category_name')->textInput(['maxlength' => true]) ?>

    <?php if(!$model->isNewRecord):?>

        <div class="form-group">
            <label class="control-label col-sm-2">Current Image</label>
            <div class="col-sm-3">
                <?php echo Html::img(Yii::$app->params['front'].$model->image, ['width'=>'150']);?>
            </div>
        </div>
    <?php endif; ?>

    <?= $form->field($model, 'file')->fileInput()->label('Image') ?>

    <div class="form-group">
	    <label class="control-label col-sm-2"></label>
	    <div class="col-sm-3">
		    <?= Html::a('<span class="btn-label"><i class="glyphicon glyphicon-chevron-left"></i></span>Cancel', 
		        ['/category/'], 
		        [
		            'class' => 'btn btn-labeled btn-info m-b-5 pull-left', 
		            'title' => 'Cancel'
		        ]) ?>&nbsp;
		    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	</div>

    <?php ActiveForm::end(); ?>

</div>
