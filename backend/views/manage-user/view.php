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

$this->title = 'View User: '.$model->users_id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
        <?php 
        // echo Breadcrumbs::widget([
        //     'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        // ]) 
        ?>
<div class="user-view">

    <section class="content-header">
        <h6>
            <ol class="breadcrumb callout callout-info">
                <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="/manage-user"> Users</a></li>
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
                            <?= Html::a('<button type="button" class="btn btn-sm btn-info"> <i class="fa fa-fw fa-chevron-left"></i> Back</button>', ['/manage-user']) ?>
                            <?= Html::a('Update', ['update', 'id' => $model->users_id], ['class' => 'btn btn-sm btn-primary']) ?>

                            <?php 
                                if ($model->status != '2') {
                                    echo Html::a('Delete', ['delete', 'id' => $model->users_id], [
                                        'class' => 'btn btn-sm btn-danger',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this item?',
                                            'method' => 'post',
                                        ],
                                    ]);
                                }
                            ?>

                            <?php  

                                $status    = ($model->status == '1') ? 'Inactivated' : 'Activated';
                                $btnStatus = ($model->status == '1') ? 'warning' : 'success';
                                echo Html::a($status, ['change-status', 'id' => $model->users_id], [
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
                                
                                // 'users_id',
                                'username',
                                'full_name',
                                'email:email',
                                [
                                    'label' => 'Birth Date',
                                    'attribute' => 'birth_date',
                                    'value' => function($model){
                                        return Helper::dateFormat($model->birth_date);
                                    }
                                ],
                                [
                                    'label' => 'Gender',
                                    'attribute' => 'gender',
                                    'value' => function($model){
                                        return $model->userGender();
                                    }
                                ],
                                // 'gender',
                                // 'password',
                                // 'password_reset_token',
                                'phone_number',
                                // 'activation_token',
                                // 'activation_date',
                                // 'auth_key',
                                // 'token_fb',
                                // 'token_g',
                                // 'user_url:url',
                                // 'picture',
                                [
                                    'label' => 'User Type',
                                    'attribute' => 'is_type',
                                    'value' => function($model){
                                        return '<span class="label label-primary">'.$model->labelType($model->is_type).'</span>';
                                    },
                                    'format' => 'raw',
                                ],
                                [
                                    'label' => 'User Status',
                                    'attribute' => 'status',
                                    'value' => function($model){
                                        return $model->userStatus($model->status);
                                    },
                                    'format' => 'raw',
                                ],
                                // 'logged_last_time',
                                // 'user_token',

                                [
                                    'label' => 'Image',
                                    'attribute' => 'picture',
                                    'value' => function($model){
                                        $noImage = 'uploads/img/no-image.png';
                                        $img = Yii::$app->params['front'].(empty($model->picture) ? $noImage : $model->picture);

                                        // $noImage = Yii::$app->params['front'].'uploads/img/no-image.png';

                                        return Html::img($img, ['width'=>'200']);
                                    },
                                    'format' => 'html',
                                ],

                                [
                                    'label' => 'User Date',
                                    'value' => function($model){
                                        $table = '<table class="table table-striped table-hover" border="1">
                                                <tr style="background-color:#c1c1c1">
                                                    <th>Registration Date</th>
                                                    <th>Activation Date</th>
                                                    <th>Updated Date</th>
                                                    <th>Deleted Date</th>
                                                    <th>Logged Last Time</th>
                                                </tr>';

                                        $table .= '<tr>
                                            <td> '.Helper::dateTimeFormat($model->created_date).'</td>
                                            <td> '.Helper::dateTimeFormat($model->activation_date).'</td>
                                            <td> '.Helper::dateTimeFormat($model->updated_date).'</td>
                                            <td> '.Helper::dateTimeFormat($model->deleted_date).'</td>
                                            <td> '.Helper::dateTimeFormat($model->logged_last_time).'</td>
                                        </tr>';

                                        $table .= '</table>';

                                        return $table;
                                    },
                                    'format' => 'html',
                                ],

                                [
                                    'label' => 'User Made',
                                    'value' => function($model){
                                        $table = '<table class="table table-striped table-hover" border="1">
                                                <tr style="background-color:#c1c1c1">
                                                    <th>Registration By</th>
                                                    <th>Updated By</th>
                                                </tr>';

                                        $table .= '<tr>
                                            <td> '.Helper::blame($model->created_by).'</td>
                                            <td> '.Helper::blame($model->updated_by).'</td>
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