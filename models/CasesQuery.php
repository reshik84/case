<?php

namespace app\models;

use yii\db\ActiveQuery;

class CasesQuery extends ActiveQuery{
    
    public function active($state = true){
        return $this->andOnCondition(['active' => true]);
    }
    
}