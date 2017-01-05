<?php
/* @var $this \yii\web\View */
use app\widgets\prize\assets\CaseAssets;
$id = Yii::$app->request->get('id', 0);
$this->registerJs("var case_id = $id", \yii\web\View::POS_BEGIN);


CaseAssets::register($this);

?>
<h3 class="hidden-xs">Последние выигрыши</h3>
<div class="row hidden-xs" id="prize">
    <?= $this->render('prize_items', ['opers' => $opers]) ?>
</div>
