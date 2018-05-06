<?php

namespace backend\controllers;

use Yii;
use common\models\Guide;
use common\models\GuideSearch;
use common\models\GuideToProduct;
use common\models\ProductImage;
use common\models\ProductImageProductGuide;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;

// use yii\web\Response;
// use yii\widgets\ActiveForm;

/**
 * GuideController implements the CRUD actions for Guide model.
 */
class GuideController extends Controller
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
     * Lists all Guide models.
     * @return mixed
     */
    public function actionIndex()
    {

        // $memory = (int)ini_get("memory_limit"); // Display your current value in php.ini (for example: 64M)
        // echo "original memory: ".$memory."<br>";
        // echo 'add '. ini_set("memory_limit",-1);
        // die();
        $searchModel = new GuideSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = (empty($searchModel->pagesize) ? 20 : $searchModel->pagesize);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Guide model.
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
     * Creates a new Guide model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Guide(['scenario' => 'created']);

        // if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        //     Yii::$app->response->format = Response::FORMAT_JSON;
        //     return ActiveForm::validate($model);
        // }

        if ($model->load(Yii::$app->request->post())) {

            // if (){

            //     echo \Yii::$app->session->setFlash('danger', Html::a("
            //         <div class='form-group'>
            //         <label class='control-label col-sm-3'></label>
            //         <div class='col-sm-6'>
            //             <b class='alert alert-danger'>".$model->errors."</b>
            //         </div>
            //         </div>&nbsp;"));
            // }

            try{

                ini_set("memory_limit",-1);

                // $picture = UploadedFile::getInstance($model, 'image');
                $picture = UploadedFile::getInstances($model, 'image');

                // $model->image = UploadedFile::getInstance($model, 'image');
                $model->image = $picture;
                $basePath = Yii::getAlias('@frontend'). '/web/uploads/img/guide';

                // $model->upload($fullPath, $fullThumbnail);
                // $model->guide_image = (string)$path;
                
                if ($model->validate() && $model->save()) {

                    if ($picture) {

                        foreach ($model->image as $key => $file) {

                            // $baseName = time() .'.'. $picture->extension;
                            $baseName = 'guide_'. $model->guide_id . '_'. rand(1000, 9999) /*.$file->name */.'.'. $file->extension;

                            $fullPath      = $basePath.'/'.$baseName;
                            $fullThumbnail = $basePath.'/thumbnail/'.$baseName;
                            $path          = 'uploads/img/guide/'.$baseName;
                            $pathThumbnail = 'uploads/img/guide/thumbnail/'.$baseName;

                            $file->saveAs($fullPath, false);
                            Image::thumbnail($fullPath, 200, 200)->save($fullThumbnail, ['quality' => 80], false);

                            $productImage = new ProductImage();
                            // $productImage->image_name        = $baseName;
                            $productImage->image_name        = $file->name;
                            $productImage->image_description = $model->guide_title;
                            $productImage->image_url         = (string)$path;
                            // $productImage->product_id        = $model->product_id;
                            $productImage->image_thumbnail   = (string)$pathThumbnail;
                            $productImage->is_feature        = 0;

                            if ($productImage->save()) {

                                $productGuideImage = new ProductImageProductGuide();
                                $productGuideImage->product_image_id = $productImage->id_product_image;
                                $productGuideImage->guide_id       = $model->guide_id;
                                $productGuideImage->save();
                            } 
                        }
                    }
                    
                    $guideToProduct = new GuideToProduct();
                    $guideToProduct->guide_guide_id = $model->guide_id;
                    $guideToProduct->product_product_id = implode(',', $model->product);

                    if ($guideToProduct->validate() && $guideToProduct->save()) {
                        Yii::$app->getSession()->setFlash('success','Data saved!');
                        // return $this->redirect(['view', 'id' => $model->guide_id]);
                        return $this->redirect(['index']);
                    } else {
                        Yii::$app->getSession()->setFlash('error','Data not saved!');
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }
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
     * Updates an existing Guide model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            try{
                // $picture = UploadedFile::getInstance($model, 'image');

                ini_set("memory_limit",-1);

                $picture = UploadedFile::getInstances($model, 'image');
                $model->image = $picture;
                $basePath = Yii::getAlias('@frontend'). '/web/uploads/img/guide';
                // if (!empty($picture)) {

                    // $model->image = $picture;
                    // $basePath = Yii::getAlias('@frontend'). '/web/uploads/img/guide';
                    // $baseName = time() .'.'. $picture->extension;

                    // $fullPath      = $basePath.'/'.$baseName;
                    // $fullThumbnail = $basePath.'/thumbnail/'.$baseName;
                    // $path     = 'uploads/img/guide/'.$baseName;

                    // $model->upload($fullPath, $fullThumbnail);
                    // $model->guide_image = (string)$path;
                // }
                
                if ($model->validate() && $model->save()) {

                    if ($picture) {

                        foreach ($model->image as $key => $file) {

                            // $baseName = time() .'.'. $picture->extension;
                            $baseName = 'guide_'. $model->guide_id . '_'. rand(1000, 9999) /*.$file->name */.'.'. $file->extension;

                            $fullPath      = $basePath.'/'.$baseName;
                            $fullThumbnail = $basePath.'/thumbnail/'.$baseName;
                            $path          = 'uploads/img/guide/'.$baseName;
                            $pathThumbnail = 'uploads/img/guide/thumbnail/'.$baseName;

                            $file->saveAs($fullPath, false);
                            Image::thumbnail($fullPath, 200, 200)->save($fullThumbnail, ['quality' => 80], false);

                            $productImage = new ProductImage();
                            // $productImage->image_name        = $baseName;
                            $productImage->image_name        = $file->name;
                            $productImage->image_description = $model->guide_title;
                            $productImage->image_url         = (string)$path;
                            // $productImage->product_id        = $model->product_id;
                            $productImage->image_thumbnail   = (string)$pathThumbnail;
                            $productImage->is_feature        = 0;

                            if ($productImage->save()) {

                                $productGuideImage = new ProductImageProductGuide();
                                $productGuideImage->product_image_id = $productImage->id_product_image;
                                $productGuideImage->guide_id       = $model->guide_id;
                                // $productGuideImage->save();
                                if (!$productGuideImage->save()) {
                                    echo '<pre>';
                                    print_r($ProductImage->errors);die();
                                }
                            } else {
                                echo '<pre>';
                                print_r($ProductImage->errors);die();
                            }
                        }
                    }
                    
                    $guideToProduct = GuideToProduct::findOne(['guide_guide_id' => $model->guide_id]);
                    $dataGuideToProduct = $guideToProduct->product_product_id;

                    $guideToProduct->product_product_id = (!empty($model->product)) ? implode(',', $model->product) : $dataGuideToProduct;

                    if ($guideToProduct->validate() && $guideToProduct->save()) {
                        Yii::$app->getSession()->setFlash('success','Data updated successfully!');
                        return $this->redirect(['view', 'id' => $model->guide_id]);
                        // return $this->redirect(['index']);

                    } else {
                        
                        Yii::$app->getSession()->setFlash('error','Data not updated!');
                        return $this->render('update', [
                            'model' => $model,
                        ]);
                    }

                } else {

                    Yii::$app->getSession()->setFlash('error','Data not updated!');
                    return $this->render('updated', [
                        'model' => $model,
                    ]);
                }

            } catch (Exception $e){
                Yii::$app->getSession()->setFlash('error',"{$e->getMessage()}");
            }

            return $this->redirect(['view', 'id' => $model->guide_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Guide model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        $model = $this->findModel($id);
        $model->guide_status = '2';
        $model->deleted_at = date('Y-m-d H:i:s');
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
        $status = ($model->guide_status == '1') ? '0' : '1';
        $model->guide_status = $status;

        if (!$model->update()) {
            Yii::$app->getSession()->setFlash('error','Data not saved!');
            // return $this->redirect(['index']);
            return $this->redirect(['view', 'id' => $model->guide_id]);
        }

        $model->save();
        
        Yii::$app->getSession()->setFlash('success','Status is Changed');
        // return $this->redirect(['index']);
        return $this->redirect(['view', 'id' => $model->guide_id]);
    }

    /**
     * Finds the Guide model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Guide the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Guide::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
