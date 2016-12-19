<?php

namespace app\modules\operations\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use app\models\OperationSearch;
use app\models\Operation;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\CashinForm;
use app\models\Operation_CASHIN;
use yii\web\NotFoundHttpException;
use app\models\CashoutForm;

class HistoryController extends Controller
{
    public $layout = '//main';
    
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                        [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex(){
        $searchModel  = \Yii::createObject(OperationSearch::className());
        $dataProvider = $searchModel->search2(\Yii::$app->request->get());
//        $dataProvider = $searchModel->search2(\Yii::$app->request->get() + ['user_id' => \Yii::$app->user->id]);
        $dataProvider->sort = FALSE;
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    
}