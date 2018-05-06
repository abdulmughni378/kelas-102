<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Guide;
use common\models\GuideCategory;
use common\models\Product;

/**
 * Site controller
 */
class GuideController extends Controller
{
    /**
     * @inheritdoc
     */
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'only' => ['logout', 'signup'],
    //             'rules' => [
    //                 [
    //                     'actions' => ['signup'],
    //                     'allow' => true,
    //                     'roles' => ['?'],
    //                 ],
    //                 [
    //                     'actions' => ['logout'],
    //                     'allow' => true,
    //                     'roles' => ['@'],
    //                 ],
    //             ],
    //         ],
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'logout' => ['get'],
    //             ],
    //         ],
    //     ];
    // }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */

    public function actionIndex($slug)
    {

        $model =  $this->findModel($slug); // ambil id slug cateory
        return $this->render('gedung_atas', [
            'model' => $this->findData($model->guide_category_id), // find by id
            // 'model' => $this->findData($slug),
            'slug_prevent' => $slug
        ]);
    }

    public function actionDetail($slug, $slug_preven)
    {
        return $this->render('gedung_atas', [
            'model' => $this->findDetail($slug),
            'slug_prevent' => $slug_preven
        ]);
    }

    public function actionProduct($slug)
    {
        return $this->render('product_detail', [
            'model' => $this->detailProduct($slug),
        ]);
    }

    protected function findModel($slug)
    {
        if (($model = GuideCategory::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findData($id)
    {
        // if (($model = Guide::findOne(['slug' => $slug])) !== null) {
        if (($model = Guide::findOne(['guide_category_guide_category_id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // detail guide
    protected function findDetail($slug)
    {
        if (($model = Guide::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function detailProduct($slug)
    {

        if (($model = Product::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // for dropdown level 2
    public function actionGetPekerjaan($id)
    {

        $regex = '/^([0-9]){1,3}$/i';
        $param = Yii::$app->request->queryParams;

        if (!preg_match($regex, $param['id'])) {
            throw new \yii\web\BadRequestHttpException('Invalid Params !');
        }

        $guideCategory = GuideCategory::findAll(['guide_category_parent' => $id]);

        if(!empty($guideCategory)){

            echo "<option value='0'>Pilih Pekerjaan</option>";

            foreach($guideCategory as $row){
                echo "<option value='".$row['guide_category_id']."'>".$row['guide_category_name']."</option>";
            }

        } else{
            echo "<option value='0'>Pilih Pekerjaan</option>";
        }
    }

    public function actionGetGuidePekerjaan($id)
    {

        $regex = '/^([0-9]){1,3}$/i';
        $param = Yii::$app->request->queryParams;

        if (!preg_match($regex, $param['id'])) {
            throw new \yii\web\BadRequestHttpException('Invalid Params !');
        }

        $guideGuide = Guide::findAll(['guide_category_guide_category_id' => $id, 'guide_status' => '1']);

        if(!empty($guideGuide)){

            $li = '';            

            foreach($guideGuide as $row){

                $li .= '<li><a href="/guide/'. $row->guideCategory->slug  .'/'.    $row->slug.'">'. ucwords(strtolower($row->guide_title)).'</a></li>';
                        
            }

            echo $li;
        } else{
            echo '';
        }
    }

    public function actionGetLabelGuidePekerjaan($id)
    {

        $regex = '/^([0-9]){1,3}$/i';
        $param = Yii::$app->request->queryParams;

        if (!preg_match($regex, $param['id'])) {
            throw new \yii\web\BadRequestHttpException('Invalid Params !');
        }

        $guideGuide = GuideCategory::findOne(['guide_category_id' => $id]);

        if(!empty($guideGuide)){

            // $ul = '<ul class="nav nav-list mb-xlg" id="result_pekerjaan">';
            
            $li = $guideGuide->guide_category_name;

            echo $li;
        } else{
            echo '';
        }
    }

}
