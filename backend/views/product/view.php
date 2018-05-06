<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;
use common\components\Helper;
use common\widgets\Alert;
use common\models\Guide;
use kartik\date\DatePicker;
use common\models\Product;
use common\models\ProductType;

// use yii\jui\DatePicker; 

/* @var $this yii\web\View */
/* @var $searchModel common\models\GuideCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'View Product: '. $model->product_id;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-view">

    <section class="content-header">
        <h6>
            <ol class="breadcrumb callout callout-info">
                <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="/product"> Products</a></li>
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
                            <?= Html::a('<button type="button" class="btn btn-sm btn-info"> <i class="fa fa-fw fa-chevron-left"></i> Back</button>', ['/product']) ?>
                            <?= Html::a('Update', ['update', 'id' => $model->product_id], ['class' => 'btn btn-sm btn-primary']) ?>

                            <?php 
                                if ($model->product_status != '2') {
                                    echo Html::a('Delete', ['delete', 'id' => $model->product_id], [
                                        'class' => 'btn btn-sm btn-danger',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this item?',
                                            'method' => 'post',
                                        ],
                                    ]);
                                }
                            ?>

                            <?php  

                                $status    = ($model->product_status == '1') ? 'Inactivated' : 'Activated';
                                $btnStatus = ($model->product_status == '1') ? 'warning' : 'success';
                                echo Html::a($status, ['change-status', 'id' => $model->product_id], [
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
                                [
                                    'label' => 'Product Category',
                                    'attribute' => 'product_type_product_type_id',
                                    'value' => function($model){
                                        // return $model->productType->description;

                                        return $model->categoryNames($model->productCategoriesNew); // fase 2
                                    },
                                    // 'format' => 'raw',
                                    // 'captionOptions' => ['tooltip' => 'Tooltip'],
                                    'contentOptions' => ['class' => 'bg-red'],
                                ],
                                'product_name',
                                'sku',
                                'product_description:html',

                                // [
                                //     'label' => 'Spesifikasi',
                                //     'attribute' => 'spesifikasi',
                                //     'value' => function($model){
                                //         return $model->spesifikasi;
                                //     },
                                //     'contentOptions' => ['class' => 'col-md-12', 'tabel table-responsive'],
                                //     'format' => 'html',
                                // ],
                                'spesifikasi:html',
                                [
                                    'label' => 'Product Status',
                                    'attribute' => 'product_status',
                                    'value' => function($model){
                                        return $model->productStatus($model->product_status);
                                    },
                                    'format' => 'raw',
                                ],
                                [
                                    'label' => 'Product Discount',
                                    'value' => function($model){
                                        $table = '<table class="table table-striped table-hover" border="1">
                                                <tr style="background-color:#ffe27a">
                                                    <th>Discount Code</th>
                                                    <th>Discount</th>
                                                </tr>';

                                        $table .= '<tr align="right";>
                                            <td> '.$model->discount_code.'</td>
                                            <td> '.Helper::persenFormat($model->discount).'</td>
                                        </tr>';

                                        $table .= '</table>';

                                        return $table;
                                    },
                                    'format' => 'html',
                                ],

                                [
                                    'label' => 'Product Price',
                                    'value' => function($model){
                                        $table = '<table class="table table-striped table-hover" border="1">
                                                <tr style="background-color:#5bff77">
                                                    <th>Base Price</th>
                                                    <th>Public Price</th>
                                                </tr>';

                                        $table .= '<tr align="right";>
                                            <td> '.Helper::rupiahFormat($model->base_price).'</td>
                                            <td> '.Helper::rupiahFormat($model->public_price).'</td>
                                        </tr>';

                                        $table .= '</table>';

                                        return $table;
                                    },
                                    'format' => 'html',
                                ],

                                [
                                    'label' => 'Product Variant',
                                    'value' => function($model){

                                        $table = '<table class="table table-striped table-hover" border="1">
                                                <tr style="background-color:#c1c1c1">
                                                    <th>Variant Type</th>
                                                    <th>Variant Item</th>
                                                </tr>';

                                        $variants = \common\models\ProductVariant::getListVariant($model->product_id);

                                        foreach ($variants as $key => $variant) {

                                            $table .= '<tr>
                                                <td> '.$variant->variant->description.'</td>
                                                <td> '.$variant->variant_item.'</td>
                                            </tr>';
                                        } 

                                        $table .= '</table>';

                                        return $table;
                                    },
                                    'format' => 'html',


                                ],

                                [
                                    'label' => 'Product Image',
                                    'value' => function($model){

                                        // $img = Yii::$app->params['front'].$model->guide_image;
                                        // $noImage = Yii::$app->params['front'].'uploads/img/no-image.png';

                                        $img = '';
                                        foreach ($model->productImagesNew as $key => $value) {
                                            $img .= Html::img(Yii::$app->params['front'].$value->productImage->image_thumbnail, ['width'=>'200', 'class' => 'imgContainer']);
                                        }

                                        return $img;
                                    },
                                    'format' => 'html',
                                ],

                                [
                                    'label' => 'Product Date',
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
                            ],
                            'template' => '<tr><th style="width:15%">{label}</th><td>{value}</td></tr>'
                        ]) ?>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>