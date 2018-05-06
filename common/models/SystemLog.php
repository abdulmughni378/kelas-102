<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "system_log".
 *
 * @property integer $system_log_id
 * @property integer $user_credential
 * @property string $is_success
 * @property string $created_date
 */
class SystemLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_credential'], 'string'],
            [['is_success', 'desc'], 'string'],
            [['created_date', 'ip_address'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'system_log_id' => 'System Log ID',
            'user_credential' => 'User Credential',
            'is_success' => 'Is Success',
            'created_date' => 'Created Date',
            'desc' => 'Description'
        ];
    }

    public function isSuccess()
    {
        switch ($this->is_success) {
            case '0':
                // return 'Inavtive';
                return '<span class="label label-danger">Failed</span>';
                break;

            case '1':
                return '<span class="label label-success">Success</span>';
                // return 'Active';
                break;

            default:
                return '-';
                break;
        }
    }
}
