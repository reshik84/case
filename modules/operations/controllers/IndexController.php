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

class IndexController extends Controller
{
    
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
    
    public function actionCashin(){
        $model = new CashinForm();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $model->createOperation();
            return $this->redirect(['payment', 'id' => $model->id]);
        }
        return $this->render('cashin', ['model' => $model]);
    }
    
    
    public function actionPayment($id){
        $operation = $this->findModel($id);
        if ($operation instanceof Operation_CASHIN &&
            $operation->status == Operation::STATUS_NOT_CONFIRMED &&
            $operation->user_id == \Yii::$app->user->id
        ){
            return $this->render('payment', ['model' => $operation]);
        }
    }
    
    public function actionCashout(){
        $api = new \yarcode\freekassa\Api();
        print_r($api->balance());
    }

    
    protected function performAjaxValidation($model)
    {
        if (\Yii::$app->request->isAjax && !\Yii::$app->request->isPjax) {
            if ($model->load(\Yii::$app->request->post())) {
                \Yii::$app->response->format = Response::FORMAT_JSON;
                echo json_encode(ActiveForm::validate($model));
                \Yii::$app->end();
            }
        }
    }
    
    public function findModel($id){
        $model = Operation::findOne(['id' => $id]);
        if($model == NULL){
            throw new NotFoundHttpException('The requested page does not exist');
        }
        return $model;
    }
    
}