<?php

namespace app\models;

use yii\helpers\ArrayHelper;

class RegistrationForm extends \dektrium\user\models\RegistrationForm{
    
    public $password_confirm;
    
    public $agree = 1;


    public function attributeLabels() {
        $labels = parent::attributeLabels();
        return ArrayHelper::merge($labels, [
            'password_confirm' => 'Повторите пароль',
        ]);
    }
    
    public function rules() {
        $rules = parent::rules();
        return ArrayHelper::merge($rules, [
            ['agree', 'required'],
            ['password_confirm', 'compare', 'compareAttribute' => 'password'],
            ['agree', 'required', 'message' => 'Согласитесь с правилами'],
            ['agree', 'compare', 'compareValue' => 1 , 'message' => 'Согласитесь с правилами'],
        ]);
    }
    
}