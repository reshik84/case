<?php

namespace app\models;

use app\models\Operation;
use app\models\Cases;


class Operation_OPEN extends Operation{
    
    public function process(){
        $user = User::findOne(['id' => $this->user_id]);
        $user->balance -= $this->sum;
        if($user->save()){
            $found = \Yii::$app->settings->get('case', 'found') + $this->sum*0.8;
            \Yii::$app->settings->set('case', 'found', $found, 'integer');
            $found = \Yii::$app->settings->get('case', 'perfect') + $this->sum*0.2;
            \Yii::$app->settings->set('case', 'perfect', $found, 'integer');
            return TRUE;
        }
        \Yii::$app->session->setFlash('cashin', 'Недостаточно средств для открытия кейса, пополните счет');
        echo \Yii::$app->controller->redirect(['/operations/index/cashin']);
        return FALSE;
    }
        
}