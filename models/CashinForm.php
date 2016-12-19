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
            ['sum', 'integer', 'min' => 1]
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
    
    public function attributeLabels() {
        return [
            'sum' => 'Сумма, руб'
        ];
    }
    
}