<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()

            ['username', 'validateUser'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            
            if (!$user->validatePassword($this->password)) {
                $this->simpanSystemLog($this->username, '0', 'Incorrect password.');               
                return $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function validateUser($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user) {
                $this->simpanSystemLog($this->username, '0', 'User not found');               
                return $this->addError($attribute, 'Incorrect username or password.');
            } 

            if ($user->status == '0') {
                $this->simpanSystemLog($this->username, '0', 'Username not active');               
                return $this->addError($attribute, 'Incorrect username or password.');
            } 

            if ($user->status == '2') {
                $this->simpanSystemLog($this->username, '0', 'Username is blocked');               
                return $this->addError($attribute, 'Incorrect username or password.');
            } 
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {

            $lastLogin = $this->getUser();
            $lastLogin->logged_last_time = date('Y-m-d H:i:s');
            $lastLogin->save(false);
            
            $this->simpanSystemLog($this->username, '1', 'logged in successfully');               
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsernameLogin($this->username);
        }

        return $this->_user;
    }

    private function simpanSystemLog($credential, $isSuccess, $desc = null)
    {
        $req = new \yii\web\Request();
        $systemLog = new \common\models\SystemLog();
        $systemLog->user_credential = $credential;
        $systemLog->is_success = $isSuccess;
        $systemLog->desc = $desc;
        $systemLog->ip_address = $req->getUserIP();
        return $systemLog->save();
    }
}
