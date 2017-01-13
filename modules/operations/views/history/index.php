<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\grid\GridView;
/**
 * @var $this  yii\web\View
 * @var $form  yii\widgets\ActiveForm
 * @var $model dektrium\user\models\SettingsForm
 */

$this->title = 'История' . ' | case-opener.com';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-3">
        <?= $this->render('//user/settings/_menu') ?>
    </div>
    <div class="col-md-9">
        <h3>Ваш баланс: <?= Yii::$app->formatter->asInteger(Yii::$app->user->identity->balance) ?> руб</h3>
        <?= Html::a('Пополнить', ['/operations/index/cashin'], ['class' => 'button']) ?>
        <?= Html::a('Вывести', ['/operations/index/cashout'], ['class' => 'button']) ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <?php Pjax::begin() ?>

<?= GridView::widget([
    'dataProvider'  =>  $dataProvider,
    'layout'        =>  "{items}\n{pager}",
    'columns' => [
        'id',
        'typename',
        [
            'attribute' => 'sum',
            'value' => function($model){
                if($model->type == 'OPEN' || $model->type == 'CASHOUT'){
                    return '-' . $model->sum;
                }
                return $model->sum;
            }
        ],
        'created_at:datetime',
        'statusname',
        'batch',
    ],
    'striped' => FALSE
]); ?>

<?php Pjax::end() ?>
        </div>
    </div>
</div>
