<?php
/* @var $this yii\web\View */
/* @var $cases[] app\models\Cases */

use yii\helpers\Html;

$this->title = 'Главная';
?>
<div class="site-index">

    <h2>Кейсы</h2>

    <div class="cases">
        <?php foreach ($cases as $case): ?>
            <div>
                <p>Содержит от <?= Yii::$app->formatter->asInteger($case->min) ?> р. до <?= Yii::$app->formatter->asInteger($case->max) ?> р. 
                    <span class="case-box">
                        <?= Html::img($case->getBehavior('image')->getUploadUrl('image')) ?>
                    </span>
                </p>
                <p>Открыть за <?= Yii::$app->formatter->asInteger($case->sum) ?> р.</p>
                <p>
                    <?= Html::a('Открыть', ['/cases/case', 'id' => $case->id], ['class' => 'button']) ?>
                    <!--<a class="button" href="#">Открыть</a>-->
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
