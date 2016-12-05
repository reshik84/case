<?php
namespace app\controllers;

use yii\base\Event;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yarcode\freekassa\actions\ResultAction;
use yarcode\freekassa\events\GatewayEvent;
use yarcode\freekassa\Merchant;
use app\models\Operation;
use app\models\Operation_CASHIN;

class BalanceController extends Controller
{
    public $enableCsrfValidation = false;

    protected $componentName = 'freeKassa';

    public function init()
    {
        parent::init();
        /** @var Api $pm */
        $freeKassa = \Yii::$app->get($this->componentName);
        $freeKassa->on(GatewayEvent::EVENT_PAYMENT_REQUEST, [$this, 'handlePaymentRequest']);
        $freeKassa->on(GatewayEvent::EVENT_PAYMENT_SUCCESS, [$this, 'handlePaymentSuccess']);
    }

    public function actions()
    {
        return [
            'result' => [
                'class' => ResultAction::className(),
                'componentName' => $this->componentName,
                'redirectUrl' => ['/site/index'],
                'sendConfirmationResponse' => true
            ],
            'success' => [
                'class' => ResultAction::className(),
                'componentName' => $this->componentName,
                'redirectUrl' => ['/site/index'],
                'silent' => true,
                'sendConfirmationResponse' => false
            ],
            'failure' => [
                'class' => ResultAction::className(),
                'componentName' => $this->componentName,
                'redirectUrl' => ['/site/index'],
                'silent' => true,
                'sendConfirmationResponse' => false
            ]
       ];
    }

    /**
     * @param GatewayEvent $event
     * @return bool
     */
    public function handlePaymentRequest($event)
    {
        $operation = Operation::findOne(['id' => ArrayHelper::getValue($event->gatewayData, 'MERCHANT_ORDER_ID'), 'status' => 0]);
        if(!$operation instanceof Operation_CASHIN ||
            $operation->sum != ArrayHelper::getValue($event->gatewayData, 'AMOUNT') ||
            ArrayHelper::getValue($event->gatewayData, 'MERCHANT_ID') != \Yii::$app->get($this->componentName)->merchantId
        )
              return;
        
        $operation->batch = ArrayHelper::getValue($event->gatewayData, 'intid');
        $operation->confirm();
        $event->invoice = $operation;
        $event->handled = true;
    }

    /**
     * @param GatewayEvent $event
     * @return bool
     */
    public function handlePaymentSuccess($event)
    {
        $invoice = $event->invoice;

        // TODO: invoice processing goes here 
    }
}
