<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use app\models\Operation;

$this->title = Yii::t('app', 'Operations');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('@dektrium/user/views/_alert', [
    'module' => Yii::$app->getModule('operations'),
]) ?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'username',
        'typename',
        'sum',
        'statusName',
        'batch',
        'memo',
        'created_at:datetime',
        'confirmed_at:datetime'
    ]
]) ?>

<?php if($model->status == Operation::STATUS_NOT_CONFIRMED): ?>
<?= Html::a('confirm', ['confirm', 'id' => $model->id], ['class' => 'btn btn-success']) ?>&nbsp;
<?= Html::a('cancel', ['cancel', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
<?php elseif($model->status == Operation::STATUS_CANCEL): ?>
<?= Html::a('delete', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
<?php endif; ?>
