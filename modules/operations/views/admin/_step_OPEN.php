<?php

use yii\helpers\Html;
use app\models\Cases;
use yii\helpers\ArrayHelper;

?>
<?= $form->field($model, 'type')->dropdownList(['' => '- Выберите -'] + $model::getTypesname(), ['disabled' => true]) ?>
<?= Html::activeHiddenInput($model, 'type') ?>
<?= $form->field($model, 'username')->textInput(['readonly' => true]) ?>
<?= $form->field($model, 'case_id')->dropdownList(['' => '- Выберите -'] + ArrayHelper::map(Cases::find()->active()->all(), 'id', 'name')) ?>
<?= $form->field($model, 'memo')->textarea() ?>