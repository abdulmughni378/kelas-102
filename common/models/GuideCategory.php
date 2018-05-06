<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\imagine\Image;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;

date_default_timezone_set("Asia/Jakarta");

/**
 * This is the model class for table "guide_category".
 *
 * @property integer $guide_category_id
 * @property string $guide_category_name
 * @property integer $guide_category_parent
 *
 * @property Guide[] $guides
 */
class GuideCategory extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guide_category';
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
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'guide_category_name',
                // 'immutable' => true,
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
            [['guide_category_name'], 'required'],
            [['guide_category_id', 'guide_category_parent'], 'integer'],
            [['guide_category_name'], 'string', 'max' => 45],
            [['slug'], 'string'],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 2, 'on' => 'created'],
            [['crated_date', 'updated_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'guide_category_id' => 'Guide Category ID',
            'guide_category_name' => 'Guide Category Name',
            'guide_category_parent' => 'Guide Category Parent',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuides()
    {
        return $this->hasMany(Guide::className(), ['guide_category_guide_category_id' => 'guide_category_id']);
    }

    public function upload($fullPath, $thumbnail)
    {
        if ($this->validate()) {

            $this->file->saveAs($fullPath, false);
            Image::thumbnail($fullPath, 200, 200)->save($thumbnail, ['quality' => 80]);

            return true;

        } else {
            // echo '<pre>';
            // print_r($this->errors);die();
            return $this->errors;
        }
    }
}
