<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GuideSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guide-search">

    <?php $form = ActiveForm::begin([
        'action' => ['login'],
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

    <?php ActiveForm::end(); ?>

</div>
