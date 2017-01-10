<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\Operation_CASHIN */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yarcode\freekassa\Merchant;
$this->title = 'Вывод средств' . ' | case-opener.com';
?>
<h3>Вывод средств</h3>
<br />
<p class="alert alert-info">Внимание! Время вывода средств на ваш кошелек от 5 минут до 24 часов</p>
<?php $form = ActiveForm::begin(['id' => 'cashin-form']) ?>

<?= $form->field($model, 'psys')->dropDownList(['-Выберите-'] + Merchant::getCurrencies()); ?>

<?= $form->field($model, 'wallet'); ?>

<?= $form->field($model, 'sum'); ?>

<?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>

<?php ActiveForm::end() ?>
<br />