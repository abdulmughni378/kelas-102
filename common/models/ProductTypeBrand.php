<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
// use yii\behaviors\SluggableBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;

date_default_timezone_set("Asia/Jakarta");

/**
 * This is the model class for table "product_type_brand".
 *
 * @property integer $id
 * @property integer $product_type_id
 * @property integer $brand_id
 * @property string $created_date
 * @property string $updated_date
 *
 * @property Brand $brand
 * @property ProductType $productType
 */
class ProductTypeBrand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_type_brand';
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
            [['product_type_id', 'brand_id'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            // [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brand::className(), 'targetAttribute' => ['brand_id' => 'brand_id']],
            // [['product_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['product_type_id' => 'product_type_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            // 'id' => 'ID',
            'product_type_id' => 'Product Type ID',
            'brand_id' => 'Brand ID',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['brand_id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductType()
    {
        return $this->hasOne(ProductType::className(), ['product_type_id' => 'product_type_id']);
    }
}
