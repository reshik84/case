<?php

namespace app\models;

use yii\helpers\ArrayHelper;
use Yii;

class RegistrationForm extends \dektrium\user\models\RegistrationForm{
    
    public $password_confirm;
    
    public $agree = 1;

    public $sponsor;

    public function init() {
        parent::init();
        $sponsor = User::find(['id' => \Yii::$app->request->cookies->getValue('sponsor_id')])->one();
        if($sponsor){
            $this->sponsor = $sponsor->username;
        }
    }
    
    public function attributeLabels() {
        $labels = parent::attributeLabels();
        return ArrayHelper::merge($labels, [
            'password_confirm' => 'Повторите пароль',
            'sponsor' => 'Вас пригласил',
        ]);
    }
    
    public function rules() {
        $rules = parent::rules();
        return ArrayHelper::merge($rules, [
            ['agree', 'required'],
            ['password_confirm', 'compare', 'compareAttribute' => 'password'],
            ['agree', 'required', 'message' => 'Согласитесь с правилами'],
            ['agree', 'compare', 'compareValue' => 1 , 'message' => 'Согласитесь с правилами'],
            ['sponsor', 'safe'],
        ]);
    }
    
    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        /** @var User $user */
        $user = Yii::createObject(User::className());
        $user->setScenario('register');
        $user->sponsor_id = \Yii::$app->request->cookies->getValue('sponsor_id');
        $user->balance = 0;
        $this->loadAttributes($user);

        if (!$user->register()) {
            return false;
        }

//        Yii::$app->session->setFlash(
//            'info',
//            Yii::t(
//                'user',
//                'Your account has been created and a message with further instructions has been sent to your email'
//            )
//        );
        Yii::$app->getUser()->login($user, 1);
        
        \Yii::$app->controller->redirect('/');

        return true;
    }
    
}