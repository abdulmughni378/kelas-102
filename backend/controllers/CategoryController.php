<?php

namespace backend\controllers;

use Yii;
use common\models\GuideCategory;
use common\models\GuideCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CategoryController implements the CRUD actions for GuideCategory model.
 */
class CategoryController extends Controller
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
     * Lists all GuideCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GuideCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = (empty($searchModel->pagesize) ? 20 : $searchModel->pagesize);
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GuideCategory model.
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
     * Creates a new GuideCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // $model = new GuideCategory();

        // if ($model->load(Yii::$app->request->post())) {
        //     if ($model->validate() && $model->save()) {
        //         // return $this->redirect(['view', 'id' => $model->guide_category_id]);
        //         return $this->redirect(['index']);
        //     } else{
        //         echo '<pre>';
        //         print_r($model->errors);die();
        //     }


        // } else {
        //     return $this->render('create', [
        //         'model' => $model,
        //     ]);
        // }

        $model = new GuideCategory(['scenario' => 'created']);

        if ($model->load(Yii::$app->request->post())) {
            try{
                // $picture = UploadedFile::getInstance($model, 'image');

                ini_set("memory_limit",-1);

                $picture = UploadedFile::getInstance($model, 'file');
                // $model->image = UploadedFile::getInstance($model, 'image');
                $model->file = $picture;

                $basePath = Yii::getAlias('@frontend'). '/web/uploads/img/guide/category';

                $baseName = time() .'.'. $picture->extension;

                $fullPath      = $basePath.'/'.$baseName;
                $fullThumbnail = $basePath.'/thumbnail/'.$baseName;
                $path     = 'uploads/img/guide/category/'.$baseName;


                $model->upload($fullPath, $fullThumbnail);
                $model->image = (string)$path;

                $model->guide_category_parent = (empty($model->guide_category_parent)) ? 0 : $model->guide_category_parent;
                
                if ($model->validate() && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->guide_category_id]);
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
     * Updates an existing GuideCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            // return $this->redirect(['view', 'id' => $model->guide_category_id]);
            try{
                // $picture = UploadedFile::getInstance($model, 'image');

                ini_set("memory_limit",-1);

                $picture = UploadedFile::getInstance($model, 'file');
                // $model->image = UploadedFile::getInstance($model, 'image');
                if (!empty($picture)) {

                    $model->file = $picture;

                    $basePath = Yii::getAlias('@frontend'). '/web/uploads/img/guide/category';

                    $baseName = time() .'.'. $picture->extension;

                    $fullPath      = $basePath.'/'.$baseName;
                    $fullThumbnail = $basePath.'/thumbnail/'.$baseName;
                    $path     = 'uploads/img/guide/category/'.$baseName;

                    $model->upload($fullPath, $fullThumbnail);
                    $model->image = (string)$path;
                }
                
                if ($model->validate() && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->guide_category_id]);
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
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing GuideCategory model.
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
     * Finds the GuideCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GuideCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GuideCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
