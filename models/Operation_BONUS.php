<?php

namespace app\models;

use yii\helpers\ArrayHelper;

class Operation_BONUS extends Operation
{
    
    public function rules() {
        $rules = parent::rules();
        return ArrayHelper::merge($rules, [
            [['sum', 'memo'], 'required']
        ]);
    }
    
    public function scenarios() {
        $scenarios = parent::scenarios();
        return ArrayHelper::merge($scenarios, [
            'step2' => ['sum', 'memo']
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
