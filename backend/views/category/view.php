<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;
use common\components\Helper;
use common\widgets\Alert;
use common\models\Guide;
use kartik\date\DatePicker;
use common\models\Product;

// use yii\jui\DatePicker; 


/* @var $this yii\web\View */
/* @var $model common\models\GuideCategory */

$this->title = 'View Guide Category: '.$model->guide_category_id;
$this->params['breadcrumbs'][] = ['label' => 'Guide Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guide-category-view">

    <section class="content-header">
        <h6>
            <ol class="breadcrumb callout callout-info">
                <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="/category"> Guide Categories</a></li>
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
                    <div class="col-lg-12 col-xs-12 col-md-12">
                        <p>
                            <?= Html::a('<button type="button" class="btn btn-sm btn-info"> <i class="fa fa-fw fa-chevron-left"></i> Back</button>', ['/category']) ?>
                            <?= Html::a('Update', ['update', 'id' => $model->guide_category_id], ['class' => 'btn btn-sm btn-primary']) ?>


                        </p>
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                // 'brand_id',
                                // 'guide_category_id',
                                'guide_category_parent',
                                'guide_category_name',
                                'slug',
                                 [
                                    'label' => 'Image',
                                    'attribute' => 'image',
                                    'value' => function($model){

                                        $img = Yii::$app->params['front'].$model->image;
                                        $noImage = Yii::$app->params['front'].'uploads/img/no-image.png';

                                        // if (file_exists($img)) {
                                            return Html::img($img, ['width'=>'200']);
                                        // } else 
                                            // return Html::img($noImage, ['width'=>'200']);
                                    },
                                    'format' => 'html',
                                ],

                                [
                                    'label' => 'Guide Date',
                                    'value' => function($model){
                                        $table = '<table class="table table-striped table-hover" border="1">
                                                <tr style="background-color:#c1c1c1">
                                                    <th>Created Date</th>
                                                    <th>Updated Date</th>
                                                </tr>';

                                        $table .= '<tr>
                                            <td> '.Helper::dateTimeFormat($model->created_date).'</td>
                                            <td> '.Helper::dateTimeFormat($model->updated_date).'</td>
                                        </tr>';

                                        $table .= '</table>';

                                        return $table;
                                    },
                                    'format' => 'html',


                                ],

                            ],
                            'template' => '<tr><th style="width:15%">{label}</th><td>{value}</td></tr>'
                        ]) ?>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
