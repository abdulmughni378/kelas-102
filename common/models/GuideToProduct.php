<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "guide_to_product".
 *
 * @property integer $guide_product_id
 * @property integer $guide_guide_id
 * @property integer $product_product_id
 *
 * @property Guide $guideGuide
 */
class GuideToProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guide_to_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['guide_guide_id', 'product_product_id'], 'required'],
            [['guide_product_id', 'guide_guide_id'], 'integer'],
            [['product_product_id'], 'string'],
            // [['guide_guide_id'], 'exist', 'skipOnError' => true, 'targetClass' => Guide::className(), 'targetAttribute' => ['guide_guide_id' => 'guide_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'guide_product_id' => 'Guide Product ID',
            'guide_guide_id' => 'Guide Guide ID',
            'product_product_id' => 'Product Product ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuideGuide()
    {
        return $this->hasOne(Guide::className(), ['guide_id' => 'guide_guide_id']);
    }
}
