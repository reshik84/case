<?php

namespace app\models;

use app\models\Cases;
use yii\data\ActiveDataProvider;

class CasesSearch extends Cases
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