<?php

namespace app\widgets\prize;

use yii\base\Widget;
use app\models\Operation;

class PrizeWidget extends Widget{
    
    public $case_id = null;
    
    public $type = 'prize';


    public function prize(){
        $query = Operation::find()
                ->where(['type' => 'PRIZE'])
                ->orderBy(['confirmed_at' => SORT_DESC])
                ->limit(7);
        if($this->case_id){
            $query->andWhere(['case_id' => $this->case_id]);
        }
        return $query;
    }

    public function lucky(){
        $query = Operation::find()
                ->select('user_id, type, SUM(`sum`) as sum')
                ->where(['type' => 'PRIZE'])
                ->groupBy('user_id')
                ->limit(7);
        if($this->case_id){
            $query->andWhere(['case_id' => $this->case_id]);
        }
        return $query;
    }

    public function run() {
                
        $foo = $this->type;
        $query = $this->$foo();
        $opers = $query->all();
        return $this->render($this->type, ['opers' => $opers]);
    }
    
}