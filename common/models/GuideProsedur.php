<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "guide_prosedur".
 *
 * @property integer $id
 * @property string $prosedur_title
 * @property string $prosedur_content
 * @property string $created_date
 * @property string $updated_date
 */
class GuideProsedur extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guide_prosedur';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prosedur_content'], 'string'],
            [['created_date', 'updated_date'], 'safe'],
            [['prosedur_title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prosedur_title' => 'Prosedur Title',
            'prosedur_content' => 'Prosedur Content',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }

    public static function findAvailableProsedur()
    {

        $data = self::find()->all();

        $data_list = ArrayHelper::map($data, 'id',
            function ($target, $defaultValue) {
                return $target['prosedur_title'];
            });

        return $data_list;
    }
}
