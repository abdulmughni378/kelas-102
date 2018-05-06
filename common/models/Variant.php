<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

date_default_timezone_set("Asia/Jakarta");

/**
 * This is the model class for table "variant".
 *
 * @property integer $variant_id
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 */
class Variant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'variant';
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
            [['description'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['description'], 'string', 'max' => 75],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'variant_id' => 'Variant ID',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function findAvailableVariant()
    {

        $data = self::find()->all();

        $data_list = ArrayHelper::map($data, 'variant_id',
            function ($target, $defaultValue) {
                return $target['description'];
            });

        return $data_list;
    }
}
