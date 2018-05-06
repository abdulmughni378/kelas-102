<?php

namespace backend\controllers;

use Yii;
use common\models\Product;
use common\models\ProductSearch;
use common\models\ProductImage;
use common\models\ProductImageProductGuide;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\base\Model;
use yii\imagine\Image;


/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = (empty($searchModel->pagesize) ? 20 : $searchModel->pagesize);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // $model = new Product();

        $model = new Product(['scenario' => 'created']);

        // if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        //     Yii::$app->response->format = Response::FORMAT_JSON;
        //     return ActiveForm::validate($model);
        // }

        if ($model->load(Yii::$app->request->post())) {

            try{

                ini_set("memory_limit",-1);

                $picture = UploadedFile::getInstances($model, 'image');
                $model->image = $picture;
                $basePath = Yii::getAlias('@frontend'). '/web/uploads/img/product';

                if ($model->validate() && $model->save()) {

                    $model->simpanProductVariant();

                    $model->simpanProductCategories();

                    if ($picture) {
                        foreach ($model->image as $key => $file) {

                            $baseName = 'prod_'. $model->product_id . '_'. rand(1000, 9999) /*.$file->name */.'.'. $file->extension;
                            $fullPath = $basePath.'/'.$baseName;
                            $fullThumbnail = $basePath.'/thumbnail/'.$baseName;

                            $path          = 'uploads/img/product/'.$baseName;
                            $pathThumbnail = 'uploads/img/product/thumbnail/'.$baseName;

                            $file->saveAs($fullPath, false);
                            Image::thumbnail($fullPath, 183, 183)->save($fullThumbnail, ['quality' => 80], false);

                            $productImage = new ProductImage();
                            // $productImage->image_name        = $baseName;
                            $productImage->image_name        = $file->name;
                            $productImage->image_description = $model->product_name;
                            $productImage->image_url         = (string)$path;
                            // $productImage->product_id        = $model->product_id;
                            $productImage->image_thumbnail   = (string)$pathThumbnail;
                            $productImage->is_feature        = 0;

                            if ($productImage->save()) {

                                $productGuideImage = new ProductImageProductGuide();
                                $productGuideImage->product_image_id = $productImage->id_product_image;
                                $productGuideImage->product_id       = $model->product_id;
                                $productGuideImage->save();
                            }
                        }
                    }

                    Yii::$app->getSession()->setFlash('success','Data saved!');
                    return $this->redirect(['view', 'id' => $model->product_id]);

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
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // $variant = \common\models\ProductVariant::find()->select(['variant_id', 'variant_item'])->where(['in', 'product_id', $id])->all();
        $model->variant = $model->productVariant;

        // echo '<pre>';
        // print_r($model->variant);die();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->product_id]);
        // } else {
        //     return $this->render('update', [
        //         'model' => $model,
        //     ]);
        // }
        if ($model->load(Yii::$app->request->post())) {

            try{

                ini_set("memory_limit",-1);

                $picture = UploadedFile::getInstances($model, 'image');
                $model->image = $picture;
                $basePath = Yii::getAlias('@frontend'). '/web/uploads/img/product';

                if ($model->validate() && $model->save()) {

                    $model->updateProductVariant($model->productVariant);

                    $model->simpanProductCategories();

                    if ($picture) {
                        foreach ($model->image as $key => $file) {

                            $baseName = 'prod_'. $model->product_id . '_'. rand(1000, 9999) /*.$file->name*/ .'.'. $file->extension;
                            $fullPath = $basePath.'/'.$baseName;
                            $fullThumbnail = $basePath.'/thumbnail/'.$baseName;

                            $path          = 'uploads/img/product/'.$baseName;
                            $pathThumbnail = 'uploads/img/product/thumbnail/'.$baseName;

                            $file->saveAs($fullPath, false);
                            Image::thumbnail($fullPath, 183, 183)->save($fullThumbnail, ['quality' => 80]);

                            $productImage = new ProductImage();
                            // $productImage->image_name        = $baseName;
                            $productImage->image_name        = $file->name;
                            $productImage->image_description = $model->product_name;
                            $productImage->image_url         = (string)$path;
                            // $productImage->product_id        = $model->product_id;
                            $productImage->image_thumbnail   = (string)$pathThumbnail;
                            $productImage->is_feature        = 0;

                            if ($productImage->save()) {

                                $productGuideImage = new ProductImageProductGuide();
                                $productGuideImage->product_image_id = $productImage->id_product_image;
                                $productGuideImage->product_id       = $model->product_id;
                                $productGuideImage->save();
                            }

                        }
                    }

                    Yii::$app->getSession()->setFlash('success','Data updated successfully!');
                    return $this->redirect(['view', 'id' => $model->product_id]);

                } else {
                    
                    Yii::$app->getSession()->setFlash('error','Data not updated!');
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
     * Deletes an existing Product model.
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
        $model->product_status = '2';
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
        $status = ($model->product_status == '1') ? '0' : '1';
        $model->product_status = $status;

        if (!$model->update()) {
            Yii::$app->getSession()->setFlash('error','Status not Changed!');
            // return $this->redirect(['index']);
            return $this->redirect(['view', 'id' => $model->product_id]);
        }

        $model->save();
        
        Yii::$app->getSession()->setFlash('success','Status is Changed');
        // return $this->redirect(['index']);
        return $this->redirect(['view', 'id' => $model->product_id]);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
