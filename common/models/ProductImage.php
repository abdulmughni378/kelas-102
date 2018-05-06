<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_image".
 *
 * @property integer $id_product_image
 * @property string $image_name
 * @property string $image_description
 * @property string $image_url
 * @property integer $product_id
 * @property string $image_thumbnail
 * @property integer $is_feature
 *
 * @property Product $product
 */
class ProductImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_url', 'image_thumbnail'], 'string'],
            [[/*'product_id', */'is_feature'], 'integer'],
            [['image_name'], 'string', 'max' => 50],
            [['image_description'], 'string', 'max' => 100],
            // [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'product_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_product_image' => 'Id Product Image',
            'image_name' => 'Image Name',
            'image_description' => 'Image Description',
            'image_url' => 'Image Url',
            // 'product_id' => 'Product ID',
            'image_thumbnail' => 'Image Thumbnail',
            'is_feature' => 'Is Feature',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    // public function getProduct()
    // {
    //     return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    // }
}
