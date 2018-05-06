<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use common\models\ProductType;
use common\models\Brand;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        // 'enableAjaxValidation' => true,
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

    <?php 

        $listToBrand = array();

        foreach ($model->typeBrand as $key => $row) {
            $listToBrand[] = $row->brand_id;
        }

    ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_product_type')->dropDownList(
        ProductType::findAvailableProductType(),
        [
            'prompt'   => 'Select Parent',
            'class'    => 'form-control select2',
            'onchange' =>'

                var parent = $(this).val();

                if (!parent) {
                    $(".upload").show("fast");
                } else {
                    $(".upload").hide("fast");


                // $.post("get-parent/?id='.'"+parent,
                //     function( data ){

                //         if (data == "0") {
                //             $(".upload").show("fast");
                //         } else {
                //             $(".upload").hide("fast");
                //         }
                //     });
                }
            '
        ])->label('Parent Product Category'); ?>

    <?php //echo Html::activeHiddenInput($model, 'brand_brand_id', ['id'=>'brand_id']); ?>

    <!-- <?php echo $form->field($model, 'brand_brand_id')->dropDownList(
        Brand::findAvailableBrand(),
        [
            'prompt'   => 'Select Parent',
            'class'    => 'form-control select2',
        ]
        ); ?> -->

    <?php if(!$model->isNewRecord):?>
        <?php 
            // $guideToProduct = GuideToProduct::find()->select('product_product_id')->where(['guide_guide_id' => $model->guide_id])->one();

            // $dtToProduct = explode(',', $guideToProduct->product_product_id);
        ?>
        <?= $form->field($model, 'brands')->dropDownList(
        Brand::findAvailableBrand(),
        [
            'prompt'      => '',
            'class'       => 'form-control select2',
            'multiple'    => "multiple",
            'placeholder' => 'Select Brand',
            'value' => $listToBrand,
        ]
        )->label('Brands'); ?>
    <?php else:?>
        <?= $form->field($model, 'brands')->dropDownList(
        Brand::findAvailableBrand(),
        [
            // 'prompt'      => 'Select Product',
            'class'       => 'form-control select2',
            'multiple'    => "multiple",
            'placeholder' => 'Select Brand',
        ]
        )->label('Brands'); ?>
    <?php endif; ?>

    <?php if(!$model->isNewRecord && ($model->getParentProduct($model->parent_product_type)['parent_product_type'] == '0')):?>
        <div class="form-group">
            <label class="control-label col-sm-2">Current Image</label>
            <div class="col-sm-3">
                <?php echo Html::img(Yii::$app->params['front'].$model->image_thumbnail, ['width'=>'150']);?>
            </div>
        </div>
    <?php endif; ?>

    <div class="upload" style="display: block;">
        <?= $form->field($model, 'file')->fileInput()->label('Image') ?>
    </div>

    <?= $form->field($model, 'order')->dropDownList(
        ProductType::findOrderProductCat(),
        [
            'prompt'      => 'Select Category',
            'class'       => 'form-control select2',
            'placeholder' => '',
        ]
        ); ?>

    <div class="form-group">
        <label class="control-label col-sm-2"></label>
        <div class="col-sm-3">
            <?= Html::a('<span class="btn-label"><i class="glyphicon glyphicon-chevron-left"></i></span>Cancel', 
                ['/product-category/'], 
                [
                    'class' => 'btn btn-labeled btn-info m-b-5 pull-left', 
                    'title' => 'Cancel'
                ]) ?>&nbsp;
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
