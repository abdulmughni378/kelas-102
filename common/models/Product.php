<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\imagine\Image;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\validators\RequiredValidator;
use common\models\ProductVariant;
use common\models\ProductProductType;

date_default_timezone_set("Asia/Jakarta");

/**
 * This is the model class for table "product".
 *
 * @property integer $product_id
 * @property string $sku
 * @property string $product_name
 * @property string $product_description
 * @property double $base_price
 * @property double $public_price
 * @property integer $discount
 * @property string $discount_code
 * @property integer $product_type_product_type_id
 * @property string $product_status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * @property ProductType $productTypeProductType
 * @property ProductImage[] $productImages
 */
class Product extends \yii\db\ActiveRecord
{
    public $image;
    public $variant;
    public $product_categories;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
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
                'attribute' => 'product_name',
                'immutable' => true,
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
            [['product_categories', 'base_price', 'public_price', 'sku', 'product_name', 'product_description'], 'required', 'on' => 'created' ],
            [['product_description', 'product_status', 'slug', 'spesifikasi'], 'string'],
            [['base_price', 'public_price'], 'number'],
            // [['product_type_product_type_id'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['sku', 'product_name'], 'string', 'max' => 100],
            [['discount_code'], 'string', 'max' => 75],
            // [['discount'], 'integer', 'length' => 2],
            // ['discount', 'is8NumbersOnly'],
            ['discount', 'string', 'max' => 2],
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 2, 'maxFiles' => 5, 'on' => 'created'],
            ['product', 'safe'],

            ['variant', 'validateVariantItem'],

            // fase 2 perubahan tabel
            ['product_categories', 'each', 'rule' => ['integer']],

            // [['Product_Type_Product_Type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['Product_Type_Product_Type_id' => 'Product_Type_id']],
        ];
    }

    public function is8NumbersOnly($attribute)
    {
        if (!preg_match('/^[0-9]{2}$/', $this->$attribute)) {
            $this->addError($attribute, 'must contain exactly 2 digits.');
        }
    }

    public function validateVariantItem($attribute)
    {
        $requiredValidator = new RequiredValidator();

        foreach($this->$attribute as $index => $row) {
            $error = null;
            $requiredValidator->validate($row['variant_item'], $error);

            if (!empty($error)) {

                $key = $attribute . '[' . $index . '][variant_item]';

                if (!empty($row['variant_id'])) {
                    return $this->addError($key, $error);
                }
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'sku' => 'SKU',
            'product_name' => 'Product Name',
            'product_description' => 'Product Description',
            'base_price' => 'Base Price',
            'public_price' => 'Public Price',
            'discount' => 'Discount',
            'discount_code' => 'Discount Code',
            'product_type_product_type_id' => 'Product Type',
            'product_status' => 'Product Status',
            'created_at' => 'Created Date',
            'updated_at' => 'Updated Date',
            'deleted_at' => 'Deleted Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductType()
    {
        return $this->hasOne(ProductType::className(), ['product_type_id' => 'product_type_product_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImage::className(), ['product_id' => 'product_id']);
    }

    // gambar product pada frontend
    public function getProductImagesCategories()
    {
        return $this->hasMany(ProductImage::className(), ['product_id' => 'product_id'])->groupBy('product_image.product_id');
    }

    public function getProductImagesGuide()
    {
        return $this->hasOne(ProductImage::className(), ['product_id' => 'product_id']);
    }

     public function getProductImageCategory()
    {
        return $this->hasOne(ProductImage::className(), ['product_id' => 'product_id']);
    }

    public function getProductVariant()
    {
        return $this->hasMany(ProductVariant::className(), ['product_id' => 'product_id']);
    }

    // perubahan fase 2 product-image many to many

    public function getProductImagesNew()
    {
        return $this->hasMany(ProductImageProductGuide::className(), ['product_id' => 'product_id']);
    }  

    public function getProductCategoriesNew()
    {
        return $this->hasMany(ProductProductType::className(), ['product_id' => 'product_id']);
    }  

    public function categoryNames($data)
    {
        $str = '';

        foreach ($data as $key => $value) {

            $str .= $value->productType->description . ', ';
        }

        return $str;
    }

    // end  

    public static function findAvailableProduct()
    {

        $data = self::find()->groupBy('product_name')->all();

        $data_list = ArrayHelper::map($data, 'product_id',
            function ($target, $defaultValue) {
                return $target['product_name'];
            });

        return $data_list;
    }

    public function upload()
    {
        if ($this->validate()) {

            $basePath = Yii::getAlias('@frontend'). '/web/uploads/img/product';

            // $fullThumbnail = $basePath.'/thumbnail/thumb_'.$baseName;
                
            foreach ($this->image as $file) {
                $baseName = time() .'.'. $file->extension;
                $fullPath = $basePath.'/'.$baseName;
                $path     = 'uploads/img/guide/'.$baseName;

                $file->saveAs($fullPath);
                // Image::thumbnail($fullPath, 200, 200)->save($thumbnail, ['quality' => 80]);
            }

            return true;
        } else {
            return $this->errors;
        }
    }

    public function simpanProductVariant()
    {
        if ($this->validate()) {

            foreach ($this->variant as $key => $row) {

                if (!empty($row['variant_id']) && !empty($row['variant_item'])) {
                    $productVariant = new ProductVariant();
                    $productVariant->variant_item = $row['variant_item'];
                    $productVariant->product_id = $this->product_id;
                    $productVariant->variant_id = $row['variant_id'];
                    $productVariant->save();
                }

            }
            return true;
        }

        return false;
    }

    public function updateProductVariant($variant)
    {
        if ($this->validate()) {

            foreach ($this->variant as $key => $row) {

                if (!empty($row['variant_id']) && !empty($row['variant_item'])) {

                    if (!array_key_exists($key, $variant)) {
                        
                        $productVariant = new ProductVariant();
                        $productVariant->variant_item = $row['variant_item'];
                        $productVariant->product_id = $this->product_id;
                        $productVariant->variant_id = $row['variant_id'];
                        $productVariant->save();

                    } else {

                        $variant[$key]->variant_item = $row['variant_item'];
                        $variant[$key]->product_id = $this->product_id;
                        $variant[$key]->variant_id = $row['variant_id'];
                        $variant[$key]->save();
                    }

                }
            }

            return true;
        }

        return false;
    }

    public function simpanProductCategories()
    {
        if ($this->validate()) {

            if (!$this->isNewRecord) { // update
                ProductProductType::deleteAll(['product_id' => $this->product_id]);
            }

            foreach ($this->product_categories as $key => $row) {

                $this->simpan(array('product_id' => $this->product_id, 'product_type_id' => $row));
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
            
            $typeBrand = new ProductProductType();
            $typeBrand->setAttributes($data);
            $typeBrand->save();
        }

        return false;
    }

    public function productStatus($productStatus)
    {
        switch ($productStatus) {
            case '0':
                // return 'Inavtive';
                return '<span class="label label-warning">Inavtive</span>';
                break;

            case '1':
                return '<span class="label label-success">Active</span>';
                // return 'Active';
                break;

            case '2':
                return '<span class="label label-danger">Deleted</span>';
                // return 'Deleted';
                break;
            
            default:
                return '-';
                break;
        }
    }

    public function productPublicPrice()
    {
        if ($this->discount != 0 || !empty($this->discount)) {

            $discount = ( (100 - $this->discount) / 100 ) * $this->public_price;
            return $discount;
        }

        return $this->public_price;
    }
}
