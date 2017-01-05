<?php
/* @var $this yii\web\View */
/* @var $cases[] app\models\Cases */

use yii\helpers\Html;

$this->title = 'Главная';
?>
<div class="site-index">
    <?= app\widgets\prize\PrizeWidget::widget(['case_id' => $case->id]) ?>
<?php 
yii\widgets\Pjax::begin([
    'enablePushState' => FALSE
])
?>
    <h2>Кейс за <?= Yii::$app->formatter->asInteger($case->sum) ?> р.</h2>
    <div class="cases">
            <div>
                <h3>Кейс за <?= Yii::$app->formatter->asInteger($case->sum) ?> р.</h3>
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
<?php
yii\widgets\Pjax::end();
?>
</div>
<div class="text-center"><?= Html::a('Все кейсы', ['/'], ['class' => 'button']) ?></div>
<h3 class="hidden-xs">Самые везучие</h3>    
<?= app\widgets\prize\PrizeWidget::widget(['type' => 'lucky']) ?>    