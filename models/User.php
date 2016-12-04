<?php

namespace app\models;

use dektrium\user\models\User as BaseUser;
use Yii;

class User extends BaseUser
{   

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        // add field to scenarios
        $scenarios['update'][]   = 'balance';
        $scenarios['register'][] = 'balance';
        
        $scenarios['register'][] = 'role';
        $scenarios['create'][] = 'role';
        $scenarios['update'][] = 'role';
        
        return $scenarios;
    }
    
    public function rules() {
        $rules = parent::rules();
        $rules[] = ['balance', 'number'];
        $rules[] = ['role', 'in', 'range' => ['user', 'admin']];
        return $rules;
    }
    
    public function getIsAdmin() {
        return (!Yii::$app->user->isGuest && Yii::$app->user->identity->role == 'admin');
    }
    
    public function beforeSave($insert) {
        if(parent::beforeSave($insert)){
            if($this->role == 'user' 
                    && ($this->id == Yii::$app->user->id
                    || $this->find()->where(['role' => 'admin'])->count() == 1)
                    ){
                $this->role = 'admin';
            }
            return TRUE;
        }
    }
    
}
