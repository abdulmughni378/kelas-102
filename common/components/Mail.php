<?php 
namespace common\components;

use Yii;
use yii\web\Request;
use yii\helpers\Html;
use yii\helpers\BaseUrl;
use yii\helpers\Url;

class Mail
{

    public function sendResetPassword($user, $token){

        try {

            \Yii::$app->mail->compose('passwordResetToken-html', ['user' => $user, 'token' => $token])
            ->setFrom([\Yii::$app->params['supportEmail'] => 'Sadeyan Admin'])
            ->setTo($user->email)
            ->setSubject('Sadeyan Password Reset ' )
            ->send();

            return array('code' => 1);
            
        } catch (Exception $e) {
            return array('code' => 0, 'message' => $e->getMessage());
        }
    }

    public function sendRegister($user, $activateToken){

        try {

            \Yii::$app->mail->compose('accountRegister-html', ['user' => $user, 'token' => $activateToken])
            ->setFrom([\Yii::$app->params['supportEmail'] => 'Blibor Admin'])
            ->setTo($user->email)
            ->setSubject('Signup Confirmation ')
            ->send();

            return array('code' => 1);
            
        } catch (Exception $e) {
            return array('code' => 0, 'message' => $e->getMessage());
        }
    }
}