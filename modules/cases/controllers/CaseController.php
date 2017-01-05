<?php

namespace app\modules\cases\controllers;

use yii\web\Controller;
use app\models\Cases;
use app\models\Operation;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use app\models\Refsys;

/**
 * Default controller for the `cases` module
 */
class CaseController extends Controller {

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
    
    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($id) {
        $case = $this->findModel($id);

        return $this->render('index', ['case' => $case]);
    }

    public function actionOpen($id) {
        $case = Cases::findOne(['id' => $id]);
        if ($case == NULL) {
            throw new NotFoundHttpException('The requested page does not exist');
        }
        /* @var $operation \app\models\Operation_OPEN */
        $operation = Operation::create('OPEN');
        $operation->case_id = $case->id;
        $operation->user_id = \Yii::$app->user->id;
        $operation->setUsernameById();
        $operation->sum = $case->sum;
        $operation->memo = 'Открытие кейса "' . $case->name . '"';
//        $operation->save();
        if($operation->confirm()){
            
            Refsys::process($operation);
            
            $prize = Operation::create('PRIZE');
            $prize->case_id = $operation->case_id;
            $prize->user_id = $operation->user_id;
            $prize->setUsernameById();
            $prize->memo = 'Выигрыш кейса "' . Cases::findOne(['id' => $operation->case_id])->name . '"';
            $prize->sum = $prize->_getPrizeSum();
            $prize->confirm();
            \Yii::$app->session->setFlash('prize', $prize->sum);
            return $this->render('open', ['case' => $case, 'sum' => \app\models\User::findOne(['id' => \Yii::$app->user->id])->balance]);
        }
        $this->redirect(['index', 'id' => $id]);
    }

    public function findModel($id) {
        $case = Cases::findOne(['id' => $id]);
        if ($case == NULL) {
            throw new NotFoundHttpException('The requested page does not exist');
        }
        return $case;
    }

}
