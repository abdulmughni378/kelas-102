<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use common\models\AuthAssignment;
use yii\behaviors\BlameableBehavior;

date_default_timezone_set("Asia/Jakarta");

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_INACTIVE = '0';
    const STATUS_ACTIVE   = '1';
    const STATUS_BLOCKED  = '2';
    const STATUS_DELETED  = '3';

    const ROLE_SUPER_ADMIN   = 'super_admin';
    const ROLE_ADMINISTRATOR = 'administrator'; // staff
    const ROLE_USER_UMUM     = 'user_umum';
    const ROLE_USER_AGEN     = 'user_agen';
    // TODO role another

    public $password_confirm;
    public $file;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_date', 'updated_date'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_date'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                'value' => new Expression('NOW()'),
            ],
            BlameableBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // ['status', 'default', 'value' => self::STATUS_ACTIVE],
            // ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['is_type','full_name', 'username', 'email', 'phone_number' ,'password', 'password_confirm'], 'required', 'on' => 'registerManageUser'],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxSize' => 1024 * 1024 * 2, 'on' => 'registerManageUser'],
            [['full_name', 'username', 'email', 'phone_number' ,'password'], 'required', 'on' => 'register'],
            // [[/*'token_exp',*/ 'status', 'province_id', 'city_id', 'postal_code', 'is_merchant'], 'integer'],
            [['username'], 'filter', 'filter' => 'strtolower'],
            [['activation_date', 'deleted_date', 'birth_date'], 'safe'],
            [['status', 'gender', 'is_type'], 'string'],
            ['email', 'email'],
            // [['device_id', 'phone'], 'string', 'max' => 20],
            [['username'], 'string', 'max' => 25],
            [['activation_token'], 'string', 'max' => 16],
            [['auth_key', 'password_reset_token'], 'string', 'length' => [32]],
            ['password', 'string', 'min' => 6],
            ['password_confirm', 'compare', 'compareAttribute' => 'password', 'on' => 'registerManageUser'],
            // [['token'], 'string', 'max' => 32],
            // [[/*'token',*/ 'password_token_forgot'], 'string', 'length' => 192],
            // [['auth_key','password_auth_key'], 'string', 'length' => 32],
            // [['notification_token', 'email', 'photo'], 'string', 'max' => 100],
            // [['password_reset_token'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['users_id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityBlame($id)
    {
        return static::findOne(['users_id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findByUsernameLogin($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function generateActivateToken(){                
        return Yii::$app->security->generateRandomString(16);
    } 

    public function upload($fullPath /*, $thumbnail*/)
    {
        if ($this->validate()) {

            $this->file->saveAs($fullPath, false);
            // Image::thumbnail($fullPath, 200, 200)->save($thumbnail, ['quality' => 80]);

            return true;
        } else 
            return $this->errors;
    }

    public function userType()
    {
        // $data = self::find()->groupBy('is_type')->all();

        // $data_list = ArrayHelper::map($data, 'is_type',
        //     function ($target, $defaultValue) {
        //         return $target['is_type'];
        //     });

        // return $data_list;

        return array(self::ROLE_ADMINISTRATOR => 'Administrator',
                    self::ROLE_USER_UMUM => 'User Umum',
                    self::ROLE_USER_AGEN => 'User Agen');
    }

    public function labelType($type)
    {
        return ucwords(preg_replace("/_/", " " , $type));
    }

    public function userStatus($userStatus)
    {
        switch ($userStatus) {
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

    public function userGender()
    {
        switch ($this->gender) {
            case '0':
                return 'Female';
                break;

            case '1':
                return 'Male';
                break;
            
            default:
            return '-';
                break;
        }
    }

    public function hakAkses()
    {
        switch ($this->is_type) {

            case self::ROLE_ADMINISTRATOR:
                return $this->simpanDataAkses(self::ROLE_ADMINISTRATOR);
                break;

            case self::ROLE_USER_UMUM:
                return $this->simpanDataAkses(self::ROLE_USER_UMUM);
                break;

            case self::ROLE_USER_AGEN:
                return $this->simpanDataAkses(self::ROLE_USER_AGEN);
                break;

            // TODO other
            
            default:
                # code...
                break;
        }

        return false;
    }

    private function simpanDataAkses($role)
    {
        if (!empty($role)) {

            $auth = new AuthAssignment();

            $auth->item_name  = $role;
            $auth->user_id    = (string)$this->users_id;
            $auth->created_at = date('U');

            return $auth->save();
        }

        return false;
    }
}
