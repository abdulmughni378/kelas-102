<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\imagine\Image;
use common\models\ProductTypeBrand;

date_default_timezone_set("Asia/Jakarta");


/**
 * This is the model class for table "product_type".
 *
 * @property integer $product_type_id
 * @property integer $parent_product_type
 * @property string $description
 * @property integer $brand_brand_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Product[] $products
 * @property Brand $brandBrand
 */
class ProductType extends \yii\db\ActiveRecord
{

    public $brands; // fase 2 multiple brand
    public $file; // fase 2 multiple brand
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_type';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                    // ActiveRecord::EVENT_BEFORE_DELETE => ['deleted_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'description',
                // 'immutable' => true,
                'ensureUnique'=>true,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['parent_product_type', 'brand_brand_id'], 'integer'],
            [['parent_product_type', 'order'], 'integer'],
            [['description', 'brands'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['description', 'image', 'image_thumbnail'], 'string', 'max' => 100],
            [['slug'], 'string'],
            // [['Brand_brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['Brand_brand_id' => 'brand_id']],

            // fase 2 perubahan tabel
            ['brands', 'each', 'rule' => ['integer']],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 2, 'on' => 'created'],
            // [['file'], 'file', 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 2, 'on' => 'created'],
            // [['file'], 'file', 'skipOnEmpty' => false, 'when' => function ($model) {
              
            //     // return $model->getParentProduct()['parent_product_type'] == 0;
            //     return $model->getParentProduct()['parent_product_type'] == 0;

            // }, 'whenClient' => "function (attribute, value) {
            //     console.log($('select#producttype-parent_product_type').val());
            //     console.log(value);
            //     return $('#file').val() != 0;
            // }"
            // ],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_type_id' => 'Product Type ID',
            'parent_product_type' => 'Parent Product Type',
            'description' => 'Category Name',
            // 'brand_brand_id' => 'Brand Brand ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'order' => 'Ordering'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['product_type_product_type_id' => 'product_type_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['product_type_product_type_id' => 'product_type_id']);
    }

    public function getParentProduct($id)
    {
        return self::find()->select(['parent_product_type'])->where(['product_type_id' => $id])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    // public function getBrand()
    // {
    //     return $this->hasOne(Brand::className(), ['brand_id' => 'brand_brand_id']);
    // }

    // perubahan fase 2
    public function getProductTypeBrand()
    {
        return $this->hasMany(ProductTypeBrand::className(), ['product_type_id' => 'product_type_id'])->with('brand');
    }

    // for updated data brand in product category
    public function getTypeBrand()
    {
        return $this->hasMany(ProductTypeBrand::className(), ['product_type_id' => 'product_type_id']);
        // return self::find()->select(['brand_id'])->where(['product_type_id' => $this->product_type_id])->all();
    }

    public static function findAvailableProductType()
    {

        $data = self::find()->groupBy('description')->all();

        $data_list = ArrayHelper::map($data, 'product_type_id',
            function ($target, $defaultValue) {
                return $target['description'];
            });

        return $data_list;
    }

    public function getParent()
    {
        $data = self::find()->select('description')->where(['product_type_id' => $this->parent_product_type])->one();

        return (!empty($data['description'])) ? $data['description'] : 'Is Parent';
    }

    public function upload($fullPath, $thumbnail)
    {
        if ($this->validate()) {
            
            $this->file->saveAs($fullPath, false);
            Image::thumbnail($fullPath, 200, 200)->save($thumbnail, ['quality' => 80]);

            return true;

        } else {
            return $this->errors;
        }
    }

    public function saveProductTypeBrand()
    {
        if ($this->validate()) {

            if (!$this->isNewRecord) { // update
                ProductTypeBrand::deleteAll(['product_type_id' => $this->product_type_id]);
            }

            foreach ($this->brands as $key => $row) {

                $this->simpan(array('product_type_id' => $this->product_type_id, 'brand_id' => $row));
            }

            return true;

        } else {

            return $this->errors;
        }

        return false;
    }

    private function simpan($data)
    {

        if (!empty($data)) {
            
            $typeBrand = new ProductTypeBrand();
            $typeBrand->setAttributes($data);
            $typeBrand->save();
            
            return true;
        }

        return false;
    }

    public function brandNames($data)
    {

        $str = '';

        foreach ($data as $key => $value) {

            $str .= $value->brand->brand_name . ', ';

        }

        return $str;
    }

    public static function findOrderProductCat()
    {

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

                $this->order = $orderOld;
                $data->order = $orderOld;
                return $data->update();

            } else 
                return $this->order;

        } 
    }
}
