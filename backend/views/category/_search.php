<?php 

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GuideCategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<?php /*

<div class="guide-category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'guide_category_id') ?>

    <?= $form->field($model, 'guide_category_name') ?>

    <?= $form->field($model, 'guide_category_parent') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
*/ ?>

<div class="guide-category-search">

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
        
    <?php ActiveForm::end(); ?>

</div>

