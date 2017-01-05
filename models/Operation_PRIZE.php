<?php

namespace app\models;

use app\models\Operation;
use app\models\Cases;

class Operation_PRIZE extends Operation{
    
    public function process(){
        $found = \Yii::$app->settings->get('case', 'found') - $this->sum;
        \Yii::$app->settings->set('case', 'found', $found, 'integer');
        $user = User::findOne(['id' => $this->user_id]);
        $user->balance += $this->sum;
        if($user->save()){
            return $this->sum;
        }
        return FALSE;
    }
    
    public function _getPrizeSum(){
        $case = Cases::findOne(['id' => $this->case_id]);
        $found = \Yii::$app->settings->get('case', 'found');
        do{
            $sum = rand($case->min, $case->real_max);
        } while ($sum > $found);
        
        $sum = $sum - $sum % 5;
        
        return $sum;
    }
    
}