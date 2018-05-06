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

        <h4 class="heading-primary">Jenis Pekerjaan</h4>
        <div class="form-group">

    <?= Html::dropDownList('guide_category_parent', null,
          Guide::findAvailableCategorylevel1(),
          [
                'prompt'      => 'Pilih Jenis Pekerjaan',
                'class'       => 'form-control select2 mb-md',
                'placeholder' => '',
                'onchange' => '
                    var level_1 = $(this).val();

                    if (!level_1) {
                        $("select#pekerjaan_id").html("<option>Pilih Pekerjaan</option>");
                    } else {

                        $.post("/guide/get-pekerjaan/?id='.'"+level_1,
                        function( data ){
                            $("select#pekerjaan_id").html( data );
                        });
                    }

                    $.ajaxSetup({ cache:false });


                '
            ]
          ) ?>
          </div>

          <div class="form-group">
          <h4 class="heading-primary">Pekerjaan</h4>
        <?= Html::dropDownList('guide_category', null,
          [],
          [
                'prompt'      => 'Pilih Pekerjaan',
                'class'       => 'form-control select2 mb-md',
                'placeholder' => '',
                'id' => 'pekerjaan_id',
                'onchange' => '
                    var level_2 = $(this).val();

                    if (!level_2 || level_2 == "0") {
                        $("#result_pekerjaan").hide(0,1);
                        $("#result_pekerjaan_default").show(0,1);
                        $("#label_result_pekerjaan").hide(0,1);
                        $("#label_result_pekerjaan_default").show(0,1);
                        
                    } else {

                        $.post("/guide/get-guide-pekerjaan/?id='.'"+level_2,
                        function( data ){

                            if (!data || data == "") {
                                $("#result_pekerjaan_default").hide(0,1);
                                $("#result_pekerjaan").hide(0,1);

                            } else {

                                $("#result_pekerjaan").html( data );
                                $("#result_pekerjaan").show(0,1);
                                $("#result_pekerjaan_default").hide(0,1);
                            }
                        });

                        $.post("/guide/get-label-guide-pekerjaan/?id='.'"+level_2,
                        function( data ){

                            if (!data || data == "") {
                                $("#label_result_pekerjaan_default").hide(0,1);
                                $("#label_result_pekerjaan").hide(0,1);

                            } else {

                                $("#label_result_pekerjaan").html( data );
                                $("#label_result_pekerjaan").show(0,1);
                                $("#label_result_pekerjaan_default").hide(0,1);
                            }
                        });

                    }

                    $.ajaxSetup({ cache:false });

                '
            ]
          ) ?>
          </div>

    <?php ActiveForm::end(); ?>

</div>
