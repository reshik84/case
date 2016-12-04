<?php

namespace app\modules\operations\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use app\models\OperationSearch;
use app\models\Operation;
use yii\web\Response;
use yii\widgets\ActiveForm;

class AdminController extends Controller
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
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }
    
    public function actionIndex(){
        $searchModel  = \Yii::createObject(OperationSearch::className());
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }
    
    public function actionCreate(){
        $post = \Yii::$app->request->post();
        unset($post['_csrf']);
        if(empty($post)){
            $model = \Yii::createObject([
                'class' => Operation::className(),
//                'scenario' => 'step1'
            ]);
        } else {
            $classname = 'app\\models\\' . key($post);
            $model = \Yii::createObject([
                'class' => $classname,
//                'scenario' => 'step2'
            ]);
        }
        $this->performAjaxValidation($model);
        if($model->load(\Yii::$app->request->post())){
            $model->setUserIdByUsername();
            if($model->validate()){
                if($model::className() == Operation::className()){
                    $classname = 'app\\models\\Operation_' . $model->type;
                    $new_model = \Yii::createObject([
                        'class' => $classname,
                    ]);
                    $new_model->setAttributes($model->attributes);
                    $new_model->setUsernameById();
                    $model = $new_model;
                } else {
                    $model->save(FALSE);
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        
        return $this->render('create', ['model' => $model]);
    }
    
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', ['model' => $model]);
    }

    
    public function actionConfirm($id){
        $model = $this->findModel($id);
        if($model->status == Operation::STATUS_NOT_CONFIRMED){
            $model->confirm();
        }
        return $this->redirect(['view', 'id' => $id]);
    }
    
    public function actionCancel($id){
        $model = $this->findModel($id);
        if($model->status == Operation::STATUS_NOT_CONFIRMED){
            $model->cancel();
        }
        return $this->redirect(['view', 'id' => $id]);
    }
    
    public function actionDelete($id){
        $model = $this->findModel($id);
        if($model->status == Operation::STATUS_CANCEL){
            $model->delete();
        }
        return $this->redirect(['index']);
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