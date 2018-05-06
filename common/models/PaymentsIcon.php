<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "footer_icon".
 *
 * @property integer $id_icon
 * @property string $type
 * @property string $name_account
 * @property string $image_url
 * @property string $created_date
 * @property string $updated_date
 */
class PaymentsIcon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payments_icon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'image_url'], 'required'],
            [['created_date', 'updated_date'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['image_url'], 'string', 'max' => 70],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_icon' => 'Id Icon',
            'name' => 'Name',
            'image_url' => 'Image Url',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
}
