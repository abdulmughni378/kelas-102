<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class RegisterForm extends Model
{
    public $fullname;
    public $username;
    public $phone_number;
    public $email;
    public $password;
    public $password_confirm;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['fullname', 'trim'],
            ['fullname', 'required'],
            // ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['fullname', 'string', 'min' => 4, 'max' => 40],

            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'common\models\User', 'message' => 'This username has already been taken.', 'on' => 'register'],
            ['username', 'string', 'min' => 6, 'max' => 40],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 30],
            ['email', 'unique', 'targetClass' => 'common\models\User', 'message' => 'This email address has already been taken.', 'on' => 'register'],

            ['phone_number', 'trim'],
            ['phone_number', 'required'],
            // ['phone_number', 'number', 'max' => 15],
            ['phone_number', 'unique', 'targetClass' => 'common\models\User', 'message' => 'This phone number has already been taken.', 'on' => 'register'],

            [['password', 'password_confirm'], 'required'],
            ['password', 'string', 'min' => 8],
            ['password_confirm', 'compare', 'compareAttribute' => 'password', 'message' => 'password not match'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function register()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->scenario = 'register';
        $user->full_name    = $this->fullname;
        $user->username     = $this->username;
        $user->email        = $this->email;
        $user->phone_number = $this->phone_number;
        $user->activation_token = $user->generateActivateToken();
        $user->setPassword($this->password);

        return $user;
        // return $user->save() ? $user : null;
    }
}
