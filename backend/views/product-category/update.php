<?php

use yii\helpers\Html;
use common\widgets\Alert;


/* @var $this yii\web\View */
/* @var $model common\models\GuideCategory */

$this->title = 'Update Product Category: ' . $model->product_type_id;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product_type_id, 'url' => ['view', 'id' => $model->product_type_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <section class="content-header">
        <h6>
            <ol class="breadcrumb callout callout-info">
                <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="/product-category/"> Product Categories</a></li>
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
                        <?= $this->render('_form', [
					        'model' => $model,
					    ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

