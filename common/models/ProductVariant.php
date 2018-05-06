<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;

date_default_timezone_set("Asia/Jakarta");
/**
 * This is the model class for table "product_variant".
 *
 * @property integer $product_variant_id
 * @property string $variant_item
 * @property integer $product_id
 * @property integer $variant_id
 * @property string $created_date
 * @property string $updated_date
 */
class ProductVariant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_variant';
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
            //     'attribute' => 'product_name',
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
            [['product_id', 'variant_id'], 'integer'],
            [['product_id', 'variant_id', 'variant_item'], 'required'],
            [['created_date', 'updated_date'], 'safe'],
            [['variant_item'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_variant_id' => 'Product Variant ID',
            'variant_item' => 'Variant Item',
            'product_id' => 'Product ID',
            'variant_id' => 'Variant ID',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }

    public function getVariant()
    {
        return $this->hasOne(Variant::className(), ['variant_id' => 'variant_id']);
    }

    public static function getListVariant($productId)
    {
        return self::find()->select(['variant_id','GROUP_CONCAT(variant_item) AS variant_item'])
                            ->where(['product_id' => $productId])
                            ->groupBy('variant_id')
                            ->all();
    }
}
