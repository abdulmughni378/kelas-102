<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GuideCategory */

$this->title = 'Update Guide Category: ' . $model->guide_category_id;
$this->params['breadcrumbs'][] = ['label' => 'Guide Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->guide_category_id, 'url' => ['view', 'id' => $model->guide_category_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="guide-category-update">

    <section class="content-header">
        <h6>
            <ol class="breadcrumb callout callout-info">
                <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="/category/"> Guide Categories</a></li>
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
