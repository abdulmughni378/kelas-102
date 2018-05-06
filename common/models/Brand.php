<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\imagine\Image;

date_default_timezone_set("Asia/Jakarta");

/**
 * This is the model class for table "brand".
 *
 * @property integer $brand_id
 * @property string $brand_name
 * @property string $brand_image
 *
 * @property ProductType[] $productTypes
 */
class Brand extends \yii\db\ActiveRecord
{
    public $image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_date', 'updated_date'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_date'],
                    // ActiveRecord::EVENT_BEFORE_DELETE => ['deleted_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                'value' => new Expression('NOW()'),
            ],
            // [
            //     'class' => SluggableBehavior::className(),
            //     'attribute' => 'guide_title',
            //     'immutable' => true,
            //     'ensureUnique'=>true,
            // ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_name', 'brand_image'], 'string', 'max' => 45],
            [['order'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 2, 'on' => 'created'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'brand_id' => 'Brand ID',
            'brand_name' => 'Brand Name',
            'brand_image' => 'Brand Image',
            'order' => 'Ordering',
        ];
    }

    public function upload($fullPath, $thumbnail)
    {
        if ($this->validate()) {

            // $watermarkImage = Yii::getAlias('@frontend').'/web/uploads/img/watermax-blibor.png';       
            // $i = Yii::getAlias('@frontend').'/web/uploads/img/brand/1509130588.png';       

            // $imagine = new \common\components\ImageTools;
            // $tools = $imagine->getImagine();
            // //open your image
            // $open = $tools->open($this->image->tempName);
            // $openWater = $tools->open($watermarkImage);
            // // get size width and height
            // $size = $open->getSize();
            // $watermarkSize = $openWater->getSize();

            // // if ($size->getHeight() < 640 + $watermarkSize->getHeight() || 
            // //     $size->getWidth() < 480 + $watermarkSize->getWidth() ) { 

            // //     // throw new Exception('Cannot paste watermark of the given size at the specified position, as it moves outside of the image\'s box');
            // //     return 'salah';
            // // } else {
            // //     return 'lolos';
            // // }

            // echo '<pre>';
            // print_r($watermarkSize->getX());

            // die();

            // // $this->image->saveAs($fullPath, false);

            // $width = $size->getWidth();
            // $height = $size->getHeight();

            // // $size = $watermarkImage->getSize();
            // // print_r($width);die();


            // $newImage = Image::watermark($i, $watermarkImage, [206, 69 ]);
            // // print_r($newImage);die();
            // $newImage->save($i);

            
            $this->image->saveAs($fullPath, false);
            Image::thumbnail($fullPath, 200, 200)->save($thumbnail, ['quality' => 80]);

            return true;

        } else {
            // echo '<pre>';
            // print_r($this->errors);die();
            return $this->errors;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTypes()
    {
        return $this->hasMany(ProductType::className(), ['Brand_brand_id' => 'brand_id']);
    }

    public static function findAvailableBrand()
    {

        $data = self::find()->all();

        $data_list = ArrayHelper::map($data, 'brand_id',
            function ($target, $defaultValue) {
                return $target['brand_name'];
            });

        return $data_list;
    }

    public static function findOrderBrand()
    {

        // $data = self::find()->where("brand.order != ''")->all();
        $data = self::find()->all();

        if (empty($data)) {

            return array('1' => '1');

        } else {

            $dt = array();

            for ($i=1; $i <= count($data); $i++) { 
                $dt[$i] = $i;
            }

            return $dt;
        }
    }

    public function aturOrder($orderOld = null)
    {
        if (!empty($this->order)) {

            $data = self::find()->where(['order' => $this->order])->one();

            if ($data) {

                $data->order = $orderOld;
                return $data->update();

            } else 
                return $this->order;

        } 
    }

}
