<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact_us".
 *
 * @property integer $contact_us_id
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $working_days
 * @property string $created_date
 * @property string $updated_date
 */
class ContactUs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact_us';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address', 'phone', 'email', 'working_days', 'updated_date'], 'required'],
            [['address'], 'string'],
            [['created_date', 'updated_date'], 'safe'],
            [['phone'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 30],
            [['working_days'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'contact_us_id' => 'Contact Us ID',
            'address' => 'Address',
            'phone' => 'Phone',
            'email' => 'Email',
            'working_days' => 'Working Days',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }
}
