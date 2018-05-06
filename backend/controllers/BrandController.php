<?php

namespace backend\controllers;

use Yii;
use common\models\Brand;
use common\models\BrandSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BrandController implements the CRUD actions for Brand model.
 */
class BrandController extends Controller
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
     * Lists all Brand models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BrandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = (empty($searchModel->pagesize) ? 20 : $searchModel->pagesize);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Brand model.
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
     * Creates a new Brand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Brand(['scenario' => 'created']);

        if ($model->load(Yii::$app->request->post())) {
            try{
                // $picture = UploadedFile::getInstance($model, 'image');

                ini_set("memory_limit",-1);

                $picture = UploadedFile::getInstance($model, 'image');
                // $model->image = UploadedFile::getInstance($model, 'image');
                $model->image = $picture;

                $basePath = Yii::getAlias('@frontend'). '/web/uploads/img/brand';

                $baseName = time() .'.'. $picture->extension;

                $fullPath      = $basePath.'/'.$baseName;
                $fullThumbnail = $basePath.'/thumbnail/'.$baseName;
                $path     = 'uploads/img/brand/'.$baseName;


                $model->upload($fullPath, $fullThumbnail);
                $model->brand_image = (string)$path;

                $model->aturOrder();

                if ($model->validate() && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->brand_id]);
                } else {
                    Yii::$app->getSession()->setFlash('error','Data not saved!');
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
     * Updates an existing Brand model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $orderOld = $model->order;

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->brand_id]);
        // } else {
        //     return $this->render('update', [
        //         'model' => $model,
        //     ]);
        // }

        if ($model->load(Yii::$app->request->post())) {
            try{
                // $picture = UploadedFile::getInstance($model, 'image');

                ini_set("memory_limit",-1);

                $picture = UploadedFile::getInstance($model, 'image');

                if (!empty($picture)) {
                    
                    $model->image = $picture;

                    $basePath = Yii::getAlias('@frontend'). '/web/uploads/img/brand';

                    $baseName = time() .'.'. $picture->extension;

                    $fullPath      = $basePath.'/'.$baseName;
                    $fullThumbnail = $basePath.'/thumbnail/'.$baseName;
                    $path     = 'uploads/img/brand/'.$baseName;

                    $model->upload($fullPath, $fullThumbnail);
                    $model->brand_image = (string)$path;
                }

                $model->aturOrder($orderOld);

                if ($model->validate() && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->brand_id]);
                } else {
                    Yii::$app->getSession()->setFlash('error','Data not saved!');
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
     * Deletes an existing Brand model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Brand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Brand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Brand::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
