<?php

namespace app\models;

use yii\base\Model;

class CashinForm extends Model
{
    
    public $sum;

    public $id;

    public function rules() {
        return [
            ['sum', 'required'],
            ['sum', 'integer', 'min' => 100, 'max' => '15000']
        ];
    }
    
    public function createOperation(){
        $operation = new Operation();
        $operation->type = 'CASHIN';
        $operation->sum = $this->sum;
        $operation->user_id = \Yii::$app->user->id;
        $operation->setUsernameById();
        $operation->save();
        $this->id = $operation->id;
    }
    
}