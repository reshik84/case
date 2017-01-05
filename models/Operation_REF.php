<?php

namespace app\models;

use yii\helpers\ArrayHelper;

class Operation_REF extends Operation
{
    
    public function process(){
        $user = User::findOne(['id' => $this->user_id]);
        $user->balance += $this->sum;
        $found = \Yii::$app->settings->get('case', 'found') - $this->sum;
        \Yii::$app->settings->set('case', 'found', $found, 'integer');
        if($user->save()){
            return TRUE;
        }
        return FALSE;
    }
    
}
