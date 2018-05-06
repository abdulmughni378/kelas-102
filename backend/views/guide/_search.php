<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GuideSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guide-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-4',
                'wrapper' => 'col-sm-7',
            ], 
        ],
    ]); ?>
    <?= $form->field($model, 'pagesize')->dropDownList(
            [5=>"5",10=>"10",20=>"20",50=>"50"], ['prompt' => 'Pilih'])->label('Show');
        ?>

    <!-- <?= $form->field($model, 'guide_id') ?> -->

    <!-- <?= $form->field($model, 'guide_date') ?> -->

    <!-- <?= $form->field($model, 'guide_date_gmt') ?> -->

    <!-- <?= $form->field($model, 'guide_post') ?> -->

    <!-- <?= $form->field($model, 'guide_title') ?> -->

    <?php // echo $form->field($model, 'guide_excerpt') ?>

    <?php // echo $form->field($model, 'guide_status') ?>

    <?php // echo $form->field($model, 'guide_comments') ?>

    <?php // echo $form->field($model, 'guide_type') ?>

    <?php // echo $form->field($model, 'guide_mime_type') ?>

    <?php // echo $form->field($model, 'comment_count') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'Guide_Category_guide_category_id') ?>

    <!-- <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div> -->

    <?php ActiveForm::end(); ?>

</div>
