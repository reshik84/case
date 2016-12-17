<?php
/* @var $this yii\web\View */
/* @var $cases[] app\models\Cases */

use yii\helpers\Html;

$this->title = 'Главная';
?>
<?php 
yii\widgets\Pjax::begin()
?>
<div class="site-index">

    <h2>Кейсы</h2>
    <div class="cases">
            <div>
                <p>Содержит от <?= Yii::$app->formatter->asInteger($case->min) ?> р. до <?= Yii::$app->formatter->asInteger($case->max) ?> р. 
                    <span class="case-box">
                        <?= Html::img($case->getBehavior('image2')->getUploadUrl('image2')) ?>
                    </span>
                </p>
                <?php if(Yii::$app->session->hasFlash('prize')): ?>
                    <p>Выигрыш <span id="prize">0</span> р.</p>
                    <?php $this->registerJs("$('#prize').animateNumber({ number: ".Yii::$app->session->getFlash('prize')." }, 1500, function(){ $('#more').removeClass('hidden')});"); ?>
                    <?php $this->registerJs("$('#bal').text('".Yii::$app->formatter->asInteger($sum)."');"); ?>
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