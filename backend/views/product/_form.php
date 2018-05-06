    <?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use common\models\ProductType;
use common\models\Variant;
use unclead\multipleinput\MultipleInput;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<style type="text/css">
    .customField{
        width: 65%;
    }
</style>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        // 'enableAjaxValidation'   => false,
        // 'enableClientValidation' => true,
        // 'validateOnChange'       => false,
        // 'validateOnSubmit'       => true,
        // 'validateOnBlur'         => false,
        'options' => ['enctype' => 'multipart/form-data'],
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2',
                    // 'offset' => 'col-sm-offset-9',
                    'wrapper' => 'col-sm-8',
                    'error' => '',
                    'hint' => '',
                ], 
            ],
        ]); ?>

    <?php if(!$model->isNewRecord):?>

        <?php 
            $listCategory = array();

            foreach ($model->productCategoriesNew as $key => $row) {
                $listCategory[] = $row->product_type_id;
            }
        ?>

        <?= $form->field($model, 'product_categories')->dropDownList(
        ProductType::findAvailableProductType(),
        [
            'class'       => 'form-control select2 customField',
            'multiple'    => "multiple",
            'placeholder' => 'Select Category',
            'value' => $listCategory,
        ]
        )->label('Product Category*'); ?>
    <?php else:?>
        <?= $form->field($model, 'product_categories')->dropDownList(
        ProductType::findAvailableProductType(),
        [
            'class'       => 'form-control select2 customField',
            'multiple'    => "multiple",
            'placeholder' => 'Select Category',
        ]
        )->label('Product Category*'); ?>
    <?php endif; ?>

    <?php /*

    <?= $form->field($model, 'product_categories')->dropDownList(
        ProductType::findAvailableProductType(),
        [
            // 'prompt'      => 'Select Product Category',
            'class'       => 'form-control select2 customField',
            'multiple'    => "multiple",
        ]
        )->label('Product Category*'); ?>
*/
    ?>
    <?= $form->field($model, 'sku')->textInput(['maxlength' => true, 'class' => 'form-control customField'])->label('SKU*'); ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true, 'class' => 'form-control customField'])->label('Product Name*'); ?>

    <?php //echo $form->field($model, 'product_description')->textarea(['rows' => 3])->label('Description*'); ?>
    <?= $form->field($model, 'product_description')->widget(TinyMce::className(), [
        'options' => ['rows' => 3],
        'language' => 'en_GB',
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ],
    ])->label('Description*');?>

    <?= $form->field($model, 'base_price')->textInput(['maxlength' => true, 'class' => 'form-control customField'])->label('Base Price*'); ?>

    <?= $form->field($model, 'public_price')->textInput(['maxlength' => true, 'class' => 'form-control customField'])->label('Public Price*'); ?>

    <?= $form->field($model, 'discount')->textInput(['maxlength' => true, 'class' => 'form-control customField']) ?>

    <?php if(!$model->isNewRecord):?>

        <div class="form-group">
            <label class="control-label col-sm-2">Current Image</label>
            <div class="col-sm-3">

                <?php 
                    // foreach ($model->productImages as $key => $value) {
                    //     echo Html::img(Yii::$app->params['front'].$value->image_url, ['width'=>'300', 'class' => 'imgContainer']);
                    // }

                    foreach ($model->productImagesNew as $key => $value) {
                        echo Html::img(Yii::$app->params['front'].$value->productImage->image_thumbnail, ['width'=>'300', 'class' => 'imgContainer']);
                    }
                ?>
            </div>
        </div>
    <?php endif; ?>

    <?php 

    // todo Tabular
    echo $form->field($model, 'image[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label('Image*');;

    ?>

    <?php //echo $form->field($model, 'spesifikasi')->textarea(['rows' => 3]) ?>
    <?= $form->field($model, 'spesifikasi')->widget(TinyMce::className(), [
        'options' => ['rows' => 3],
        'language' => 'en_GB',
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]);?>

    <?= $form->field($model, 'variant')->widget(MultipleInput::className(), [
        // 'max' => 4,
        'columns' => [
            [
                'name'  => 'variant_id',
                'type'  => 'dropDownList',
                'title' => 'Variant Type',
                // 'defaultValue' => 1,
                'items' => Variant::findAvailableVariant(),
                'options' => [
                    'prompt' => 'Pilih Variant'
                ]
                
            ],
            [
                'name'  => 'variant_item',
                'title' => 'Variant Item',
                'enableError' => true,
                // 'items' => function($data) {
                //     return $data['variant_item'];
                // },
                'options' => [
                    'class' => 'input-variant_item'
                ]
            ]
        ]
     ]);
    ?>

    <div class="form-group">
        <label class="control-label col-sm-2"></label>
        <div class="col-sm-3">
            <?= Html::a('<span class="btn-label"><i class="glyphicon glyphicon-chevron-left"></i></span>Cancel', 
                ['/product/'], 
                [
                    'class' => 'btn btn-labeled btn-info m-b-5 pull-left', 
                    'title' => 'Cancel'
                ]) ?>&nbsp;
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 

// $this->registerJs(
//     "$('select#product-variant-2-variant_id').on('click', function(data) { console.log(data) });",
//     \yii\web\View::POS_READY
// );

$this->registerJs(
    "$('#w2').find('input').val('')",
    \yii\web\View::POS_READY
);
?>
;