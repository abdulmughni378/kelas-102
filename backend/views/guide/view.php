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
/* @var $searchModel common\models\GuideCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'View Guide: '.$model->guide_id;
$this->params['breadcrumbs'][] = ['label' => 'Guides', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
        <?php 
        // echo Breadcrumbs::widget([
        //     'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        // ]) 
        ?>

<style type="text/css">
    .tableCustom>tbody>tr>td{

        border-top: 1px solid #808080;
    }
</style>
<div class="guide-view">

    <section class="content-header">
        <h6>
            <ol class="breadcrumb callout callout-info">
                <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="/guide/"> Guides</a></li>
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
                            <?= Html::a('<button type="button" class="btn btn-sm btn-info"> <i class="fa fa-fw fa-chevron-left"></i> Back</button>', ['/guide']) ?>
                            <?= Html::a('Update', ['update', 'id' => $model->guide_id], ['class' => 'btn btn-sm btn-primary']) ?>

                            <?php 
                                if ($model->guide_status != '2') {
                                    echo Html::a('Delete', ['delete', 'id' => $model->guide_id], [
                                        'class' => 'btn btn-sm btn-danger',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this item?',
                                            'method' => 'post',
                                        ],
                                    ]);
                                }
                            ?>

                            <?php  

                                $status    = ($model->guide_status == '1') ? 'Inactivated' : 'Activated';
                                $btnStatus = ($model->guide_status == '1') ? 'warning' : 'success';
                                echo Html::a($status, ['change-status', 'id' => $model->guide_id], [
                                    'class' => 'btn btn-sm btn-'.$btnStatus,
                                    'data' => [
                                        'confirm' => 'Are you sure you want to '.$status.' this item?',
                                        'method' => 'post',
                                    ],
                                ]);
                            ?>

                        </p>
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                // 'guide_id',
                                // 'guide_date',
                                // 'guide_date_gmt',
                                [
                                    'label' => 'Guide Category',
                                    'attribute' => 'guide_category_guide_category_id',
                                    'value' => function($model){
                                        return $model->guideCategory->guide_category_name;
                                    },
                                    // 'format' => 'raw',
                                    // 'captionOptions' => ['tooltip' => 'Tooltip'],
                                    'contentOptions' => ['class' => 'bg-red'],
                                ],
                                'guide_title',
                                'guide_post:html',
                                'guide_excerpt:html',
                                'guide_comments',
                                'comment_count',
                                [
                                    'label' => 'Guide Status',
                                    'attribute' => 'guide_status',
                                    'value' => function($model){
                                        return $model->guideStatus($model->guide_status);
                                    },
                                    'format' => 'raw',
                                ],

                                [
                                    'label' => 'Guide Image',
                                    // 'attribute' => 'guide_image',
                                    'value' => function($model){

                                        // $img = Yii::$app->params['front'].$model->guide_image;
                                        // $noImage = Yii::$app->params['front'].'uploads/img/no-image.png';

                                        // // if (file_exists($img)) {
                                        //     return Html::img($img, ['width'=>'200']);
                                        // // } else 
                                        //     // return Html::img($noImage, ['width'=>'200']);

                                        $img = '';
                                        foreach ($model->guideImagesNew as $key => $value) {
                                            $img .= Html::img(Yii::$app->params['front'].$value->productImage->image_thumbnail, ['width'=>'200', 'class' => 'imgContainer']);
                                        }

                                        return $img;
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
                                                    <th>Deleted Date</th>
                                                </tr>';

                                        $table .= '<tr>
                                            <td> '.Helper::dateTimeFormat($model->created_at).'</td>
                                            <td> '.Helper::dateTimeFormat($model->updated_at).'</td>
                                            <td> '.Helper::dateTimeFormat($model->deleted_at).'</td>
                                        </tr>';

                                        $table .= '</table>';

                                        return $table;
                                    },
                                    'format' => 'html',


                                ],
                                [
                                    'label' => 'Product',
                                    'value' => function($model){
                                        $products = Product::find()
                                            ->select('product_id, product_name')
                                            ->where(['IN','product_id',explode(',', $model->guideProducts->product_product_id)])
                                            ->all();

                                        $table = '<table class="table table-striped table-hover tableCustom" border="1">
                                                <tr style="background-color:aqua">
                                                    <th>Product ID</th>
                                                    <th>Product Name</th>
                                                    <th>Product Image</th>
                                                </tr>';

                                        foreach ($products as $key => $product) {

                                            // $img = Yii::$app->params['front'].$product->productImagesGuide->image_url;
                                            $img = isset($product->productImagesGuide->image_url) ? $product->productImagesGuide->image_url : 'uploads/img/no-image.png';

                                            $table .= '<tr>
                                                <td> '.$product->product_id.'</td>
                                                <td> '.$product->product_name.'</td>
                                                <td align="center"> '.Html::img(Yii::$app->params['front'].$img, ['width'=>'50']) .'</td>
                                            </tr>';
                                        } 

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