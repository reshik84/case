<?php
/**
 * @var app\models\Cases $case
 * @var yii\widgets\ActiveForm $form
 */

use yii\helpers\Html;
?>

<?= $form->field($case, 'name')->textInput(['maxlength' => 255]) ?>
<?= $form->field($case, 'sum')->textInput(['type' => 'number']) ?>
<?= $form->field($case, 'min')->textInput(['type' => 'number']) ?>
<?= $form->field($case, 'max')->textInput(['type' => 'number']) ?>
<?= $form->field($case, 'real_max')->textInput(['type' => 'number']) ?>
<?= $form->field($case, 'risk')->textInput(['type' => 'number']) ?>
<?= $form->field($case, 'active')->checkbox() ?>
<?= Html::img($case->getBehavior('image')->getUploadUrl('image'), ['class' => 'img-thumbnail']) ?>
<?= $form->field($case, 'image')->fileInput(['accept' => 'image/*']) ?>
<?= Html::img($case->getBehavior('image2')->getUploadUrl('image2'), ['class' => 'img-thumbnail']) ?>
<?= $form->field($case, 'image2')->fileInput(['accept' => 'image/*']) ?>