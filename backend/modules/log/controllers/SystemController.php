<?php

namespace backend\modules\log\controllers;

use Yii;
use yii\web\Controller;
use common\models\SystemLogSearch;

/**
 * Default controller for the `log` module
 */
class SystemController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
    	$searchModel = new SystemLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = (empty($searchModel->pagesize) ? 20 : $searchModel->pagesize);

        $success = $searchModel->searchSuccess();
        $failed = $searchModel->searchFailed();

        return $this->render('system-login', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'report' => [
	            'success' => $success,
	            'failed' => $failed
            ]
        ]);
    }
}
