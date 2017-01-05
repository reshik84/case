<?php

namespace app\websocket\cases;

use app\models\Operation;

class CaseWebsocketDaemonHandler extends \morozovsk\websocket\Daemon{
    
    protected function onOpen($connectionId, $info) {//it is called when new connection is open
    }
    
    protected function onMessage($connectionId, $data, $type) {
        
        
        try{
            $data1 = json_decode($data);
        } catch (\Exception $e){
            die();
        }
        
        if(!isset($data1->case_id)){
            $data1->case_id = 0;
        }
        
        switch ($data1->type){
            case 'prize_start':
                $message = \yii\helpers\Json::encode([
                    'type' => 'prize_start',
                    'html' => $this->prize_start($data1->case_id),
                    'case_id' => $data1->case_id
                ]);
                break;
            case 'new_prize':
                $message = \yii\helpers\Json::encode([
                    'new_prize' => [
                        'type' => 'new_prize',
                        'html' => $this->new_prize(),
                        'case_id' => $data1->case_id
                    ],
                    'lucky' => [
                        'type' => 'lucky',
                        'html' => $this->lucky(),
                        'case_id' => $data1->case_id
                    ]
                ]);
//                $message = \yii\helpers\Json::encode([
//                    'type' => 'new_prize',
//                    'html' => $this->new_prize(),
//                    'case_id' => $data1->case_id
//                ]);
                break;
        }
//        $message = 'user #' . $connectionId . ': ' . strip_tags($data);
        foreach ($this->clients as $clientId => $client) {
            $this->sendToClient($clientId, $message);
        }
    }
    
    
    protected function prize_start($case_id = null){
        $query = Operation::find()
                ->where(['type' => 'PRIZE'])
                ->orderBy(['confirmed_at' => SORT_DESC])
                ->limit(7);
        if($case_id){
            $query->andWhere(['case_id' => $case_id]);
        }
        $opers = $query->all();

        return \Yii::$app->controller->view->render('@app/widgets/prize/views/prize_items', ['opers' => $opers]);
    }
    
    protected function new_prize(){
        $query = Operation::find()
                ->where(['type' => 'PRIZE'])
                ->orderBy(['confirmed_at' => SORT_DESC])
                ->limit(1);
        $oper = $query->one();

        return \Yii::$app->controller->view->render('@app/widgets/prize/views/prize_item', ['oper' => $oper]);
    }
    
    
    public function lucky(){
        $query = Operation::find()
                ->select('user_id, type, SUM(`sum`) as sum')
                ->where(['type' => 'PRIZE'])
                ->groupBy('user_id')
                ->limit(7);
        $opers = $query->all();
        return \Yii::$app->controller->view->render('@app/widgets/prize/views/lucky_items', ['opers' => $opers]);
    }
    
}