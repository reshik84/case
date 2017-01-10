<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\Operation_CASHIN */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'Пополнение счета' . ' | case-opener.com';
?>
<h2>Пополнение счета</h2>
<?php if(Yii::$app->session->hasFlash('cashin')): ?>
<br />
<div class="alert alert-danger">
    <?= Yii::$app->session->getFlash('cashin') ?>
</div>
<?php endif; ?>
<br />
<?php $form = ActiveForm::begin(['id' => 'cashin-form']) ?>

<?= $form->field($model, 'sum'); ?>

<?= Html::submitButton('Пополнить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>

<?php ActiveForm::end() ?>
<br />