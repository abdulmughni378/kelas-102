<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "social_media".
 *
 * @property integer $id
 * @property string $type
 * @property string $url
 * @property string $name_account
 * @property string $created_date
 * @property string $updated_date
 */
class SocialMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'social_media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'url', 'name_account', 'updated_date'], 'required'],
            [['created_date', 'updated_date'], 'safe'],
            [['type'], 'string', 'max' => 20],
            [['url'], 'string', 'max' => 30],
            [['name_account'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'url' => 'Url',
            'name_account' => 'Name Account',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
}
