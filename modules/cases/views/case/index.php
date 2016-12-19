<?php
/* @var $this yii\web\View */
/* @var $cases[] app\models\Cases */

use yii\helpers\Html;

$this->title = 'Главная';
?>
<?php 
yii\widgets\Pjax::begin([
    'enablePushState' => FALSE
])
?>
<div class="site-index">

    <h2>Кейсы</h2>
    <div class="cases">
            <div>
                <p>Содержит от <?= Yii::$app->formatter->asInteger($case->min) ?> р. до <?= Yii::$app->formatter->asInteger($case->max) ?> р. 
                    <span class="case-box">
                        <?= Html::img($case->getBehavior('image')->getUploadUrl('image')) ?>
                    </span>
                </p>
                <p>Открыть за <?= Yii::$app->formatter->asInteger($case->sum) ?> р.</p>
                <p>
                    <?= Html::a('Открыть', ['/cases/case/open', 'id' => $case->id], ['class' => 'button']) ?>
                </p>
            </div>
    </div>
</div>
<?php
yii\widgets\Pjax::end();
?>
<div class="text-center"><?= Html::a('Все кейсы', ['/'], ['class' => 'button']) ?></div>