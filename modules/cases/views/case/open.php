<?php
/* @var $this yii\web\View */
/* @var $cases[] app\models\Cases */

use yii\helpers\Html;

$this->title = 'Открыть кейс | case-opener.com';
?>
<?php 
yii\widgets\Pjax::begin()
?>
<div class="site-index">

    <h2>Кейс за <?= Yii::$app->formatter->asInteger($case->sum) ?> р.</h2>
    <div class="cases">
            <div>
                <h3>Кейс за <?= Yii::$app->formatter->asInteger($case->sum) ?> р.</h3>
                <p>Содержит от <?= Yii::$app->formatter->asInteger($case->min) ?> р. до <?= Yii::$app->formatter->asInteger($case->max) ?> р. 
                    <span class="case-box">
                        <?= Html::img($case->getBehavior('image')->getUploadUrl('image'), ['id' => 'img_open']) ?>
                        <?= Html::img($case->getBehavior('image2')->getUploadUrl('image2'), ['id' => 'img_open2', 'class' => 'hidden']) ?>
                    </span>
                </p>
                <?php if(Yii::$app->session->hasFlash('prize')): ?>
                <p class="prize_sum hidden">Выигрыш <span><?= Yii::$app->session->getFlash('prize') ?></span> р.</p>
                    <?php $this->registerJsFile('/js/case.js'); ?>
                    <?php $this->registerJs("opencase('".Yii::$app->formatter->asInteger($sum)."');"); ?>
                <?php endif; ?>
                <p>
                    <?= Html::a('Еще раз', ['/cases/case', 'id' => $case->id], ['class' => 'button hidden', 'id' => 'more']) ?>
                </p>
            </div>
    </div>
</div>
<?php
yii\widgets\Pjax::end();
?>