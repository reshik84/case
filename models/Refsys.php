<?php

namespace app\models;

use yii\base\Model;

class Refsys extends Model{
    
    public static function process(Operation_OPEN $operation){
        
        $refsys = explode(';', \Yii::$app->settings->get('case', 'refsys'));
        
        $user = User::findOne(['id' => $operation->user_id]);
        foreach ($refsys as $r){
            if(!$user = $user->sponsor){
                break;
            }
            $ref_oper = Operation::create('REF');
            $ref_oper->user_id = $user->id;
            $ref_oper->sum = $operation->sum * $r / 100;
            $ref_oper->memo = 'Рефские ' . $r . '%';
            $ref_oper->setUsernameById();
            $ref_oper->confirm();
        }
    }
    
}