<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\Breadcrumbs;
use common\components\Helper;
use common\widgets\Alert;
use common\models\Guide;
use kartik\date\DatePicker;
// use yii\jui\DatePicker; 

/* @var $this yii\web\View */
/* @var $searchModel common\models\GuideCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php 
    $templateAction = (Yii::$app->user->can('super_admin')) ? '{view} {update} {delete}' : '{view} {update}'
?>

<div class="user-index">
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
                            
                        <?= Html::a('<button type="button" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> User</button>', ['create']); ?>

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
                                'rowOptions' => function($model) {
                                    switch ($model->status) {
                                        case '0':
                                            return ['class' => 'info'];
                                            break;

                                        case '2':
                                            return ['class' => 'danger'];
                                            break;
                                        
                                        default:
                                            break;
                                    }
                                },
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],

                                    'full_name',
                                    'username',
                                    // 'birth_date',
                                    'email:email',
                                    // 'password',
                                    // 'password_reset_token',
                                    [
                                        'label' => 'Phone',
                                        'attribute' => 'phone_number'
                                    ],
                                    // 'activation_token',
                                    // 'activation_date',
                                    // 'auth_key',
                                    // 'token_fb',
                                    // 'token_g',
                                    // 'user_url:url',
                                    // 'picture',
                                    // 'logged_last_time',
                                    // 'user_token',
                                    // 'status',
                                    // 'created_date',
                                    // 'updated_date',
                                    // 'gender',
                                    // [
                                    //     'attribute' => 'gender',
                                    //     'value' => function($model){
                                    //         return $model->userGender();
                                    //     },
                                    //     'filter'    => Html::activeDropDownList($searchModel, 'gender', ['0' => 'Female', '1' => 'Male'], ['class'=>'form-control ', 'prompt' => 'Select']),
                                    //     'contentOptions' => ['style' => 'text-align:center;width:8%;'],
                                    // ],
                                    [
                                        'label' => 'User Type',
                                        'attribute' => 'is_type',
                                        'filter'    => Html::activeDropDownList(
                                                        $searchModel, 'is_type', 
                                                        array('super_admin' => 'Super Admin') + $searchModel->userType(), 
                                                        ['class'=>'form-control ', 'prompt' => 'Select']),
                                        'value' => function($model){
                                            return $model->labelType($model->is_type);
                                        },
                                        'contentOptions' => ['style' => 'text-align:center;width:11%;'],
                                    ],
                                    [
                                        'attribute' => 'status',
                                        // 'filter' => ['0' => 'Inactive', '1' => 'Active', '2' => 'Deleted'],
                                        'filter'    => Html::activeDropDownList($searchModel, 'status', ['0' => 'Inactive', '1' => 'Active', '2' => 'Deleted'], ['class'=>'form-control ', 'prompt' => 'Select']),
                                        'value' => function($model){
                                            return $model->userStatus($model->status);
                                        },
                                        'format' => 'raw',
                                        'contentOptions' => ['style' => 'text-align:center;width:10%;'],
                                    ],
                                    [
                                        'label' => 'Registration Date',
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
                                        'contentOptions' => ['style' => 'text-align:center;width:13%;'],
                                    ],

                                    // ['class' => 'yii\grid\ActionColumn'],
                                    [
                                        'class' => 'yii\grid\ActionColumn',
                                        'header' => 'Action',
                                        'headerOptions' => ['style' => 'color:#3c8dbc;'],
                                        // 'template' => '{update}',
                                        'template' => $templateAction,
                                        'contentOptions' => ['style' => 'text-align: center;width:13%;'],
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
                                                           'params'=>['id' => $model->users_id],
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
        </div>
    </section>
</div>