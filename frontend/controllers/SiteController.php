<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use common\components\Mail;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\RegisterForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        // _1506785069
        // echo strlen("rLS6BjXlUJefEFcxFN7A7x1LcfPh3jHe");die();
        // echo '<pre>';
        // print_r(Yii::$app->user->identity);
        // echo 'sukses';die();
        // $this->layout = 'main_layout';
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = 'main_layout';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionRegister()
    {
        $model = new RegisterForm();
        $model->scenario = 'register';
        if ($model->load(Yii::$app->request->post())) {

            $mail = new Mail();
            $connection = \Yii::$app->db;
            $transaction = $connection->beginTransaction();

            if ($user = $model->register()) {

                if ($user->validate() && $user->save()) {
                    $kirim = $mail->sendRegister($user, $user->activation_token);

                    if ($kirim['code'] === 0) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('danger', 'Mohon maaf terjadi kesalahan, silahkan coba lagi.');
                        return $this->goHome();
                    }
                    
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Terima kasih '. $user->username.', Silahkan cek email anda untuk melakukan aktivasi akun.');
                    return $this->goHome();
                }
            } 
            // else {
            //     Yii::$app->session->setFlash('error', 'Terjadi kesalahan');
            //     return $this->goHome();
            // }
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $kirim = $model->sendEmail();
            
            if ($kirim['code'] === 1) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionConfirm()
    {
        try {

            $regex = '/^([a-zA-Z0-9\w\W]{16})$/i';
            $param = Yii::$app->request->queryParams;
            if (!array_key_exists('token', $param)) 
            {
                Yii::$app->session->setFlash('error', 'Invalid your request.');
                return $this->goHome();
            }

            if (!preg_match($regex, $param['token'])) 
            {
                // throw new BadRequestHttpException('Invalid your request.');
                Yii::$app->session->setFlash('error', 'Invalid your request.');
                return $this->goHome();
            }

            $user = User::findOne(['activation_token' => $param['token']]);

            if ($user) {

                if ($user->status === '1') {

                    Yii::$app->session->setFlash('info', 'Your Account is Activated.');
                    return $this->goHome();

                } else {

                    $user->status = '1';
                    $user->activation_date = date('Y-m-d H:i:s');
                    
                    if ($user->save()) {
                        Yii::$app->session->setFlash('success', 'Your Account Activated.');
                        return $this->goHome();
                    } else {
                        // echo '<pre>';
                        // print_r($user->errors);die();
                        Yii::$app->session->setFlash('danger', 'Terjadi kesalahan.');
                        return $this->goHome();
                    }
                }
                
            } else{
                throw new NotFoundHttpException('The requested page does not exist.');
            }

        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }

    public function actionSend($url)
    {
        return \yii\helpers\Url::to(["https://api.whatsapp.com/send", "phone"=> Yii::$app->params['phone'], "text" => $url]);
    }
}
