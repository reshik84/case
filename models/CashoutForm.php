<?php

namespace app\models;

use yii\base\Model;
use yarcode\freekassa\Merchant;

class CashoutForm extends Model
{
    
    public $sum;
    
    public $psys;
    
    public $wallet;

    public $id;

    public function rules() {
        return [
            ['sum', 'required'],
            ['sum', 'integer', 'min' => 100, 'max' => 15000],
            ['psys', 'required'],
            ['psys', 'in', 'range' => array_keys(Merchant::getCurrencies())],
            ['wallet', 'required']
        ];
    }
    
    public function attributeLabels() {
        return [
            'sum' => 'Сумма',
            'psys' => 'Платежная система',
            'wallet' => 'Кошелек',
        ];
    }
    
    public function createOperation(){
        $operation = new Operation();
        $operation->type = 'CASHOUT';
        $operation->sum = $this->sum;
        $operation->user_id = \Yii::$app->user->id;
        $operation->psys = $this->psys;
        $operation->wallet = $this->wallet;
        $operation->setUsernameById();
        $operation->save();
        $this->id = $operation->id;
        return Operation::findOne(['id' => $this->id]);
    }
    
}