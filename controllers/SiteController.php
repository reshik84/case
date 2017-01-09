<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Cases;

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
                'only' => ['logout'],
                'rules' => [
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
                    'logout' => ['post'],
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
     * @return string
     */
    public function actionIndex($ref = '')
    {
        if(Yii::$app->user->isGuest && $ref != ''){
            $sponsor = \app\models\User::find(['username' => $ref])->one();
            if($sponsor){
                \Yii::$app->response->cookies->add(new \yii\web\Cookie([
                    'name' => 'sponsor_id',
                    'value' => $sponsor->id
                ]));
            }
            return $this->redirect('/');
        }
        $cases = Cases::find()->where(['active' => '1'])->all();
        return $this->render('index', ['cases' => $cases]);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionRules()
    {
        return $this->render('rules');
    }
    
    public function actionReferal(){
        return $this->render('refsys');
    }


//    public function actionTest(){
//        return $this->render('test');
//    }
//    public function actionTest2(){
////        $sp = \app\websocket\Client::websocket_open('tcp://127.0.0.1:8004');
////        \app\websocket\Client::websocket_write($sp, 'test');
//        Yii::$app->websocket->write('123');
//        print_r(Yii::$app->websocket->read());
//    }
    
}
