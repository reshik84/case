<?php
/**
 * @var app\models\Operation $model
 * @var yii\widgets\ActiveForm $form
 */

use yii\helpers\Html;
?>

<?= $form->field($model, 'type')->dropdownList(['' => '- Выберите -'] + $model::getTypesname()) ?>
<?= $form->field($model, 'username') ?>