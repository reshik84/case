<?php

use yii\helpers\Html;

?>
<?= $form->field($model, 'type')->dropdownList(['' => '- Выберите -'] + $model::getTypesname(), ['disabled' => true]) ?>
<?= Html::activeHiddenInput($model, 'type') ?>
<?= $form->field($model, 'username')->textInput(['readonly' => true]) ?>
<?= $form->field($model, 'sum') ?>
<?= $form->field($model, 'memo')->textarea() ?>