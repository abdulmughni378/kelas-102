<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\imagine\Image;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;

date_default_timezone_set("Asia/Jakarta");

/**
 * This is the model class for table "guide".
 *
 * @property integer $guide_id
 * @property string $guide_date
 * @property string $guide_date_gmt
 * @property string $guide_post
 * @property string $guide_title
 * @property string $guide_excerpt
 * @property string $guide_status
 * @property string $guide_comments
 * @property string $guide_type
 * @property string $guide_mime_type
 * @property string $comment_count
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $guide_category_guide_category_id
 *
 * @property GuideCategory $guideCategoryGuideCategory
 * @property GuideToProduct[] $guideToProducts
 */
class Guide extends \yii\db\ActiveRecord
{

    public $product;
    public $image;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guide';
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
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'guide_title',
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
            [['guide_title', 'guide_category_guide_category_id', 'guide_post', 'guide_excerpt', 'product'], 'required'],
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 2, 'maxFiles' => 5, 'on' => 'created'],
            ['product', 'safe'],
            [['guide_post', 'guide_title', 'guide_excerpt', 'guide_status', 'slug'], 'string'],
            [['guide_comments', 'guide_category_guide_category_id', 'prosedur_id'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['guide_date', 'guide_date_gmt', 'guide_type', 'guide_mime_type', 'comment_count'], 'string', 'max' => 45],
            // [['guide_image'], 'string', 'max' => 75],
            // [['Guide_Category_guide_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => GuideCategory::className(), 'targetAttribute' => ['Guide_Category_guide_category_id' => 'guide_category_id']],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'guide_id' => 'Guide ID',
            'guide_date' => 'Guide Date',
            'guide_date_gmt' => 'Guide Date Gmt',
            'guide_post' => 'Guide Post',
            'guide_title' => 'Guide Title',
            'guide_excerpt' => 'Guide Excerpt',
            'guide_status' => 'Guide Status',
            'guide_comments' => 'Guide Comments',
            'guide_type' => 'Guide Type',
            'guide_mime_type' => 'Guide Mime Type',
            'comment_count' => 'Comment Count',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'guide_image' => 'Guide Image',
            'guide_category_guide_category_id' => 'Guide Category',
            'prosedur_id' => 'Prosedur'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuideCategory()
    {
        return $this->hasOne(GuideCategory::className(), ['guide_category_id' => 'guide_category_guide_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuideProducts()
    {
        return $this->hasOne(GuideToProduct::className(), ['guide_guide_id' => 'guide_id']);
    }

    public function getGuideProsedur()
    {
        return $this->hasOne(GuideProsedur::className(), ['id' => 'prosedur_id']);
    }

    // fase 2
    public function getGuideImagesNew()
    {
        return $this->hasMany(ProductImageProductGuide::className(), ['guide_id' => 'guide_id']);
    }  
    // end

    public static function findAvailableCategory()
    {

        $data = GuideCategory::find()->groupBy('guide_category_name')->all();

        $data_list = ArrayHelper::map($data, 'guide_category_id',
            function ($target, $defaultValue) {
                return $target['guide_category_name'];
            });

        return $data_list;
    }

    public static function findAvailableCategorylevel1()
    {

        $data = GuideCategory::find()->where(['guide_category_parent' => '0'])->groupBy('guide_category_name')->all();

        $data_list = ArrayHelper::map($data, 'guide_category_id',
            function ($target, $defaultValue) {
                return $target['guide_category_name'];
            });

        return $data_list;
    }

    public function upload($fullPath, $thumbnail)
    {
        if ($this->validate()) {

            $this->image->saveAs($fullPath, false);
            Image::thumbnail($fullPath, 200, 200)->save($thumbnail, ['quality' => 80]);

            return true;

        } else {
            // echo '<pre>';
            // print_r($this->errors);die();
            return $this->errors;
        }
    }

    public function guideStatus($guideStatus)
    {
        switch ($guideStatus) {
            case '0':
                // return 'Inavtive';
                return '<span class="label label-warning">Inavtive</span>';
                break;

            case '1':
                return '<span class="label label-success">Active</span>';
                // return 'Active';
                break;

            case '2':
                return '<span class="label label-danger">Deleted</span>';
                // return 'Deleted';
                break;
            
            default:
                return '-';
                break;
        }
    }
}
