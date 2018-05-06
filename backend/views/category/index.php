<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GuideCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Guide Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
        <?php 
        // echo Breadcrumbs::widget([
        //     'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        // ]) 
        ?>
<div class="guide-category-index">

    <section class="content-header">
        <h6>
            <ol class="breadcrumb callout callout-info">
                <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
                <li class="active"><?= Html::encode($this->title)?></li>
            </ol>
        </h6>
    </section>

    <section class="content">
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
                            
                        <?= Html::a('<button type="button" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> Guide Category</button>', ['create']); ?>

                        <span class="pull-right">
                            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                        </span>
                    </div>     

                    <div class="col-lg-12 col-xs-12 col-md-12">
                    <?php Pjax::begin(); ?>    <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'filterSelector' => '#' . Html::getInputId($searchModel, 'pagesize'),
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                // 'guide_category_id',
                                'guide_category_parent',
                                'guide_category_name',
                                [
                                    'label' => 'Image',
                                    'attribute' => 'image',
                                    'value' => function($model){

                                        $img = Yii::$app->params['front'].$model->image;
                                        $noImage = Yii::$app->params['front'].'uploads/img/no-image.png';

                                        // if (file_exists($img)) {
                                            return Html::img($img, ['width'=>'100']);
                                        // } else 
                                            // return Html::img($noImage, ['width'=>'200']);
                                    },
                                    'format' => 'html',
                                ],

                                // ['class' => 'yii\grid\ActionColumn'],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => 'Action',
                                    // 'template' => '{update}',
                                    'template' => '{view} {update} {delete}',
                                    'buttons' => [

                                        'view' => function ($url) {
                                            return Html::a(
                                                '<button type="button" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-eye-open"></i></button>',
                                                $url,
                                                [
                                                    'title' => 'View',
                                                    'data-pjax' => '0',
                                                    'data' => [
                                                        'method' => 'post',
                                                    ]
                                                ]
                                            );
                                        },

                                        'update' => function ($url) {
                                            return Html::a(
                                                '<button type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-pencil"></i></button>',
                                                $url,
                                                [
                                                    'title' => 'Update',
                                                    'data-pjax' => '0',
                                                    'data' => [
                                                        'method' => 'post',
                                                    ]
                                                ]
                                            );
                                        },

                                        'delete' => function ($url,$model) {
                                           // return Html::a('<span class="glyphicon glyphicon-remove-circle"></span>',
                                           return Html::a(
                                                '<button type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></button>',
                                               $url,
                                               [
                                                   'data'=>[
                                                       'method' => 'post',
                                                       'confirm' => 'Are you sure?',
                                                       // 'params'=>['id' => $model->guide_category_id],
                                                   ],
                                                   'title' => 'Delete',
                                               ]
                                           );
                                       },
                                    ]
                                ],
                            ],
                        ]); ?>
                    <?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
