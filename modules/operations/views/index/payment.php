<?= \yarcode\freekassa\RedirectForm::widget([
    'message' => 'Redirecting to payment gateway...',
    'api' => Yii::$app->get('freeKassa'),
    'invoiceId' => $model->id,
    'amount' => $model->sum,
    'email' => Yii::$app->user->identity->email
]); ?>