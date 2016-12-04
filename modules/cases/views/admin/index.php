<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\models\UserSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var UserSearch $searchModel
 */

$this->title = Yii::t('app', 'Manage cases');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('@dektrium/user/views/_alert', [
    'module' => Yii::$app->getModule('cases'),
]) ?>

<?= $this->render('_menu') ?>

<?php Pjax::begin() ?>

<?= GridView::widget([
    'dataProvider'  =>  $dataProvider,
    'filterModel'   =>  $searchModel,
    'layout'        =>  "{items}\n{pager}",
    'columns' => [
        'name',
        'risk',
        'active',
        [
            'header' => Yii::t('app', 'Active'),
            'value' => function($model){
                if ($model->active) {
                    return Html::tag('span',Yii::t('app', 'Active'), [
                        'class' => 'btn btn-xs btn-success btn-block',
                    ]);
                } else {
                    return Html::tag('span',Yii::t('app', 'Unactive'), [
                        'class' => 'btn btn-xs btn-danger btn-block',
                    ]);
                }
            },
            'format' => 'raw'
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
        ],
    ],
]); ?>

<?php Pjax::end() ?>