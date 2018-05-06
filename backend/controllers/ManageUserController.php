<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ManageUserController implements the CRUD actions for User model.
 */
class ManageUserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = (empty($searchModel->pagesize) ? 20 : $searchModel->pagesize);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User(['scenario' => 'registerManageUser']);

        if ($model->load(Yii::$app->request->post())) {

            try{

                $connection = \Yii::$app->db;
                $transaction = $connection->beginTransaction();

                ini_set("memory_limit",-1);

                $picture = UploadedFile::getInstance($model, 'file');
                $model->file = $picture;


                if (!empty($picture)) {

                    $basePath = Yii::getAlias('@frontend'). '/web/uploads/img/user';
                    $baseName = time().'_'. rand(1000, 9999) .'.'. $picture->extension;

                    $fullPath = $basePath.'/'.$baseName;
                    // $fullThumbnail = $basePath.'/thumbnail/thumb_'.$baseName;
                    $path     = 'uploads/img/user/'.$baseName;
                }


                if ($model->validate() && $model->save()) {

                    // todo hak akses user
                    if (!$model->hakAkses()) {
                        $transaction->rollBack();
                        Yii::$app->getSession()->setFlash('error', 'Data not saved!');
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }

                    $model->upload($fullPath/*, $fullThumbnail*/);
                    $model->picture = (string)$path;
                    $model->status  = User::STATUS_ACTIVE;
                    $model->activation_date = date('Y-m-d H:i:s');
                    $model->setPassword($model->password_confirm);
                    $model->save(false);

                    $transaction->commit();
                    
                    Yii::$app->getSession()->setFlash('success', 'Data saved!');
                    return $this->redirect(['view', 'id' => $model->users_id]);

                } else {

                    echo '<pre>';
                    print_r($model->erros);

                    Yii::$app->getSession()->setFlash('error', 'Data not saved!');
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            } catch (Exception $e){
                Yii::$app->getSession()->setFlash('error',"{$e->getMessage()}");
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->users_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionDelete($id)
    // {
    //     $this->findModel($id)->delete();

    //     return $this->redirect(['index']);
    // }

    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        $model = $this->findModel($id);
        $model->status = '2';
        $model->deleted_date = date('Y-m-d H:i:s');
        if (!$model->update()) {
            Yii::$app->getSession()->setFlash('error','Data not deleted!');
            return $this->redirect(['index']);
        }

        $model->save();
        
        return $this->redirect(['index']);
    }

    public function actionChangeStatus($id)
    {
        $model  = $this->findModel($id);
        $status = ($model->status == '1') ? '0' : '1';
        $model->status = $status;

        if (!$model->update()) {
            Yii::$app->getSession()->setFlash('error','Data not saved!');
            // return $this->redirect(['index']);
            return $this->redirect(['view', 'id' => $model->users_id]);
        }

        $model->save();
        
        Yii::$app->getSession()->setFlash('success','Status is Changed');
        // return $this->redirect(['index']);
        return $this->redirect(['view', 'id' => $model->users_id]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
