<?php

namespace app\modules\cases\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use yii\helpers\Url;
use app\models\CasesSearch;
use app\models\Cases;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Default controller for the `admin` module
 */
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
    
    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        Url::remember('', 'actions-redirect');
        $searchModel  = \Yii::createObject(CasesSearch::className());
        $dataProvider = $searchModel->search(\Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
        ]);
    }
    
    
    public function actionCreate()
    {
        /** @var Cases $case */
        $case = \Yii::createObject([
            'class' => Cases::className(),
            'scenario' => 'insert'
        ]);
        
        $this->performAjaxValidation($case);
        
        if($case->load(\Yii::$app->request->post()) && $case->save()){
            \Yii::$app->getSession()->setFlash('success', \Yii::t('app', 'Case has been created'));
            return $this->redirect(['index']);
        }
        return $this->render('create', [
            'case' => $case,
        ]);
    }
    
    
    public function actionUpdate($id)
    {
        $case = $this->findModel($id);
        $case->scenario = 'update';

        $this->performAjaxValidation($case);

        if ($case->load(\Yii::$app->request->post()) && $case->save()) {
            \Yii::$app->getSession()->setFlash('success', \Yii::t('app', 'Case have been updated'));
            return $this->redirect('index');
        }

        return $this->render('update', [
            'case' => $case,
        ]);
    }
    
    public function actionDelete($id){
        $case = $this->findModel($id);
        if($case == NULL){
            throw new Exception('Model not found');
        }
        $case->active = 0;
        $case->save();
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
        $case = Cases::findOne(['id' => $id]);
        if($case == NULL){
            throw new NotFoundHttpException('The requested page does not exist');
        }
        return $case;
    }
    
}