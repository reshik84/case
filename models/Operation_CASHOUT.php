<?php

namespace app\models;

use app\models\Operation;
use yii\helpers\ArrayHelper;

class Operation_CASHOUT extends Operation {

    public function rules() {
        $rules = parent::rules();
        return ArrayHelper::merge($rules, [
                        [['sum'], 'required'],
                        [['psys'], 'required'],
                        [['wallet'], 'required'],
        ]);
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        return ArrayHelper::merge($scenarios, [
                    'step2' => ['sum', 'psys', 'wallet']
        ]);
    }

    public function process() {
        $user = User::findOne(['id' => $this->user_id]);
        if ($user->balance - $this->sum >= 0) {
            $user->balance -= $this->sum;
            if ($user->save()) {
                $data = \Yii::$app->freeKassa_api->withdraw($this->wallet, $this->sum, 'cashout', $this->psys, NULL);
                if ($data['status'] == 'info') {
                    $this->batch = $data['data']['payment_id'];
                    $this->save();
                    return TRUE;
                } elseif ($data['status'] == 'error') {
                    $this->addError('sum', $data['desc']);
                }
            }
        } else {
            $this->addError('sum', 'Недостаточно средств на вашем счету');
        }
        return FALSE;
    }

}
