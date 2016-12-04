<?php

namespace app\models;

use app\models\Cases;
use yii\data\ActiveDataProvider;
use app\models\Operation;

class OperationSearch extends Operation
{
    
    public function search($params){
        $query = $this->find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        
        return $dataProvider;
    }
    
    
}