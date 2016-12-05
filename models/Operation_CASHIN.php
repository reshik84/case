<?php

namespace app\models;

use app\models\Operation;
use yii\helpers\ArrayHelper;

class Operation_CASHIN extends Operation{
    
    
    public function rules() {
        $rules = parent::rules();
        return ArrayHelper::merge($rules, [
            [['sum'], 'required']
        ]);
    }
    
    public function scenarios() {
        $scenarios = parent::scenarios();
        return ArrayHelper::merge($scenarios, [
            'step2' => ['sum']
        ]);
    }
    
    public function process(){
        $user = User::findOne(['id' => $this->user_id]);
        $user->balance += $this->sum;
        if($user->save()){
            return TRUE;
        }
        return FALSE;
    }
    
}