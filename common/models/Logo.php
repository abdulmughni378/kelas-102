<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "logo".
 *
 * @property integer $id
 * @property string $name
 * @property string $image_url
 * @property string $created_date
 * @property string $updated_date
 */
class Logo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'logo';
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
            'id' => 'ID',
            'name' => 'Name',
            'image_url' => 'Image Url',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
}
