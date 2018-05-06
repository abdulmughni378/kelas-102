<?php

namespace backend\controllers;

use Yii;
use common\models\Brand;
use common\models\ProductType;
use common\models\ProductTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use yii\web\Response;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductCategoryController extends Controller
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
        $searchModel = new ProductTypeSearch();
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

        $model = new ProductType(['scenario' => 'created']);

        // if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        //     Yii::$app->response->format = Response::FORMAT_JSON;
        //     return ActiveForm::validate($model);
        // }

        if ($model->load(Yii::$app->request->post())) {

            try{

                ini_set("memory_limit",-1);

                $picture = UploadedFile::getInstance($model, 'file');

                if (!empty($picture)) { // sementara, TODO event parent == 0 upload file show and required
                    $model->file = $picture;

                    $basePath = Yii::getAlias('@frontend'). '/web/uploads/img/product/categories';

                    $baseName = time() .'.'. $picture->extension;
                    
                    $fullPath      = $basePath.'/'.$baseName;
                    $fullThumbnail = $basePath.'/thumbnail/'.$baseName;
                    $path          = 'uploads/img/product/categories/'.$baseName;
                    $pathThumbnail = 'uploads/img/product/categories/thumbnail/'.$baseName;


                    $model->upload($fullPath, $fullThumbnail);
                    $model->image           = (string)$path;
                    $model->image_thumbnail = (string)$pathThumbnail;
                }

                $model->parent_product_type = (empty($model->parent_product_type)) ? '0' : $model->parent_product_type;
                $model->aturOrder();

                if ($model->validate() && $model->save() && $model->saveProductTypeBrand()) {

                    return $this->redirect(['view', 'id' => $model->product_type_id]);

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
        // $model = $this->findModel($id);

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->product_type_id]);
        // } else {
        //     return $this->render('update', [
        //         'model' => $model,
        //     ]);
        // }

        $model = $this->findModel($id);
        $orderOld = $model->order;

        if ($model->load(Yii::$app->request->post())) {

            try{

                ini_set("memory_limit",-1);

                $picture = UploadedFile::getInstance($model, 'file');

                if (!empty($picture)) {

                    $model->file = $picture;

                    $basePath = Yii::getAlias('@frontend'). '/web/uploads/img/product/categories';

                    $baseName = time() .'.'. $picture->extension;
                    
                    $fullPath      = $basePath.'/'.$baseName;
                    $fullThumbnail = $basePath.'/thumbnail/'.$baseName;
                    $path          = 'uploads/img/product/categories/'.$baseName;
                    $pathThumbnail = 'uploads/img/product/categories/thumbnail/'.$baseName;


                    $model->upload($fullPath, $fullThumbnail);
                    $model->image           = (string)$path;
                    $model->image_thumbnail = (string)$pathThumbnail;

                }

                $model->parent_product_type = (empty($model->parent_product_type)) ? '0' : $model->parent_product_type;
                $model->aturOrder($orderOld);

                if ($model->validate() && $model->save() && $model->saveProductTypeBrand()) {

                    return $this->redirect(['view', 'id' => $model->product_type_id]);

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
        // $model = $this->findModel($id);
        // $model->product_status = '2';
        // $model->deleted_at = date('Y-m-d H:i:s');
        // if (!$model->update()) {
        //     Yii::$app->getSession()->setFlash('error','Data not deleted!');
        //     return $this->redirect(['index']);
        // }

        // $model->save();
        
        return $this->redirect(['index']);
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
        if (($model = ProductType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetBrand($id)
    {

        $regex = '/^([0-9]){1,3}$/i';
        $param = Yii::$app->request->queryParams;

        if (!preg_match($regex, $param['id'])) {
            throw new \yii\web\BadRequestHttpException('Invalid Params !');
        }

        $productType = ProductType::findOne(['product_type_id' => $id]);

        if(!empty($productType)){
            
            $data = $productType->brand->brand_name;
            return json_encode(array('name' => $data, 'id' => $productType->brand_brand_id));
            echo $data;
        } else{
            echo '';
        }
    }

    public function actionGetParent($id)
    {
        $model = new ProductType();
        $parent = empty($model->getParentProduct($id)['parent_product_type']) ? 0 : $model->getParentProduct($id)['parent_product_type'];

        return json_encode($parent);
    }

}
