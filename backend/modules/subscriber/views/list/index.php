<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\Breadcrumbs;
use common\components\Helper;
use common\widgets\Alert;
use kartik\date\DatePicker;
// use yii\jui\DatePicker; 

/* @var $this yii\web\View */
/* @var $searchModel common\models\GuideCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subscribers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscriber-index">

    <section class="content-header">
        <h6>
            <ol class="breadcrumb callout callout-info">
                <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
                <li class="active"><?= Html::encode($this->title)?></li>
            </ol>
        </h6>
    </section>

    <section class="content">
        <?= Alert::widget() ?>  
        <!-- Small boxes (Stat box) -->
        <div class="box box-info">
            <div class="box-header">
                <!-- <i class="fa fa-envelope"></i> -->

                <h3 class="box-title"><?= Html::encode($this->title)?></h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <!-- /. tools -->
            </div>
            <div class="box-body">
                <div class="row">

                    <div class="col-md-12">

                        <span class="pull-right">
                            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                        </span>
                    </div>     

                    <div class="col-lg-12 col-xs-12 col-md-12">

                        <div class="table-responsive">
                            <?php Pjax::begin(); ?>    <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'filterSelector' => '#' . Html::getInputId($searchModel, 'pagesize'),
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],

                                    'email',
                                    [
                                        'label' => 'Subscribe Date',
                                        'attribute' => 'created_date',
                                        'filter' => DatePicker::widget([
                                            'name' => 'created_date', 
                                            'model' => $searchModel, 
                                            'attribute' => 'created_date', 
                                            'options' => ['placeholder' => 'Select Date'],
                                            'type' => DatePicker::TYPE_INPUT,
                                            'pluginOptions' => [
                                                'format' => 'yyyy-mm-dd',
                                                // 'todayHighlight' => true,
                                                'autoclose' => true,
                                            ]
                                        ]),
                                        'value' => function($model){
                                            return Helper::dateTimeFormat($model->created_date);
                                        },
                                        // 'headerOptions' => ['style' => 'text-align:center;'],
                                        'contentOptions' => ['style' => 'text-align:center;width:18%;'],
                                    ],
                                    

                                    // ['class' => 'yii\grid\ActionColumn'],
                                ],
                            ]); ?>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
</div>