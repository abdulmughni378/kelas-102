<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use common\models\Guide;
use common\models\Product;
use common\models\GuideToProduct;
use common\models\GuideProsedur;
use kartik\file\FileInput;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Guide */
/* @var $form yii\widgets\ActiveForm */
?>

<style type="text/css">
    /*.select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #222d32;
        border: 1px solid #aaa;
        border-radius: 4px;
        cursor: default;
        float: left;
        margin-right: 5px;
        margin-top: 5px;
        padding: 0 5px;
    }*/

    .customField{
        width: 65%;
    }
</style>

<div class="guide-form">

    <?php $form = ActiveForm::begin([
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

    <?= $form->field($model, 'guide_category_guide_category_id')->dropDownList(
        Guide::findAvailableCategory(),
        [
            'prompt'      => 'Select Category',
            'class'       => 'form-control select2 customField',
            'placeholder' => '',
        ]
        ); ?>
    
    <?= $form->field($model, 'guide_title')->textInput(['maxlength' => true, 'class' => 'form-control customField']) ?>

    <?php //echo $form->field($model, 'guide_post')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'guide_post')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'en_GB',
        'clientOptions' => [
            'plugins' => [
                'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools    contextmenu colorpicker textpattern help'
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            'table_class_list' => [
                ['title' => 'None', 'value' => 'table'],
                ['title' => 'Table Striped', 'value' => 'table table-striped'],
                ['title' => 'Table Bordered', 'value' => 'table table-bordered'],
                ['title' => 'Table Hover', 'value' => 'table table-hover'],
                ['title' => 'Table Condensed', 'value' => 'table table-condensed']
            ],
            'style_formats' => [
                ['title' => 'Bold text', 'inline' => 'b'],
                ['title' => 'Table Header', 'selector' => 'tr', 'classes' => 'theade']
            ],
            'content_css' => [
                '//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
                'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css'
            ],
            'table_advtab' => false,
            'image_advtab' => true,
            'invalid_styles' => [
                'th' => 'width height',
                'td' => 'width height',
                'tr' => 'width height',
                'table' => 'width height',
                '*' => 'border'
            ]
        ]
    ]);?>

    <?php //echo $form->field($model, 'guide_excerpt')->textarea(['rows' => 3]) ?>
    <?= $form->field($model, 'guide_excerpt')->widget(TinyMce::className(), [
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

    <!-- <?php if(!$model->isNewRecord):?>

        <div class="form-group">
            <label class="control-label col-sm-2">Current Image</label>
            <div class="col-sm-3">
                <?php echo Html::img(Yii::$app->params['front'].$model->guide_image, ['width'=>'150']);?>
            </div>
        </div>
    <?php endif; ?> -->

    <?php 

    $img = '';
    // if (!$model->isNewRecord) {
    //     $img = Html::img(Yii::$app->params['front'].$model->guide_image, ['width'=>'80%', 'class'=>"file-preview-image"]);
    // }
     if(!$model->isNewRecord):?>

        <div class="form-group">
            <label class="control-label col-sm-2">Current Image</label>
            <div class="col-sm-3">

                <?php 
                    // foreach ($model->productImages as $key => $value) {
                    //     echo Html::img(Yii::$app->params['front'].$value->image_url, ['width'=>'300', 'class' => 'imgContainer']);
                    // }

                    foreach ($model->guideImagesNew as $key => $value) {
                        echo Html::img(Yii::$app->params['front'].$value->productImage->image_thumbnail, ['width'=>'200', 'class' => 'imgContainer']);
                    }
                ?>
            </div>
        </div>
    <?php endif; ?>

    <?php 

        // todo Tabular
        echo $form->field($model, 'image[]')->fileInput(['multiple' => true, 'accept' => 'image/*'])->label('Image*');;
    
    ?>


    <?php  /*
    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*', 'multiple' => true],
            'pluginOptions' => [
                // 'initialPreviewShowDelete' => true,
                // 'previewFileType' => 'image',
                // 'showRemove' => false,
                'showUpload' => false,
                // 'initialPreview'=> [
                //     // '<img src="' . Yii::$app->params['front'] . $model->guide_image.'" class="file-preview-image">',
                //     $img
                // ],
                'initialPreviewConfig' => [
                    // ['caption' => $model->guide_image, 'size' => '873727'],
                    // ['caption' => 'Earth.jpg', 'size' => '1287883'],
                     // 'config' => [
                     //        'caption' => "People-1.jpg",
                     //        'width' => "120px",
                     //        'url' => "/site/file-delete",
                     //        'key' => 1,
                     //    ],
                ],
                // 'initialPreviewAsData'=>true,
                'initialCaption'=> $model->guide_image,
                // 'overwriteInitial'=>false,
            ],
        ]); ?>

    */ ?>
    <?php if(!$model->isNewRecord):?>
        <?php 
            $guideToProduct = GuideToProduct::find()->select('product_product_id')->where(['guide_guide_id' => $model->guide_id])->one();

            $dtToProduct = explode(',', $guideToProduct->product_product_id);
        ?>
        <?= $form->field($model, 'product')->dropDownList(
        Product::findAvailableProduct(),
        [
            // 'prompt'      => '',
            'class'       => 'form-control select2 customField',
            'multiple'    => "multiple",
            'placeholder' => 'Select Product',
            'value' => $dtToProduct
        ]
        ); ?>
    <?php else:?>
        <?= $form->field($model, 'product')->dropDownList(
        Product::findAvailableProduct(),
        [
            // 'prompt'      => 'Select Product',
            'class'       => 'form-control select2 customField',
            'multiple'    => "multiple",
            'placeholder' => 'Select Product',
        ]
        ); ?>
    <?php endif; ?>

    <?= $form->field($model, 'prosedur_id')->dropDownList(
        GuideProsedur::findAvailableProsedur(),
        [
            'prompt'      => 'Select Prosedur',
            'class'       => 'form-control select2 customField',
            'placeholder' => 'Select Prosedur',
        ]
        ); ?>

    <div class="form-group">
        <label class="control-label col-sm-2"></label>
        <div class="col-sm-3">
            <?= Html::a('<span class="btn-label"><i class="glyphicon glyphicon-chevron-left"></i></span>Cancel', 
                ['/guide/'], 
                [
                    'class' => 'btn btn-labeled btn-info m-b-5 pull-left', 
                    'title' => 'Cancel'
                ]) ?>&nbsp;
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>