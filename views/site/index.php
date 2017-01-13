<?php
/* @var $this yii\web\View */
/* @var $cases[] app\models\Cases */

use yii\helpers\Html;

$this->title = 'Главная | case-opener.com';
?>
<div class="site-index">
<?= app\widgets\prize\PrizeWidget::widget() ?>
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
<h3 class="hidden-xs">Самые везучие</h3>    
<?= app\widgets\prize\PrizeWidget::widget(['type' => 'lucky']) ?>    
    
</div>
<?php
if(!Yii::$app->request->cookies->get('first')):
?>


<div class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="color: black; text-align: center">Добро пожаловать на сайт case-opener.com</h4>
      </div>
      <div class="modal-body" style="color: black;">
        <p>Открывайте кейсы и получайте деньги!</p>
        <p>Каждый при регистрации получает <span style="font-size: 24px;">50</span> рублей на счет!</p>
      </div>
        <div class="modal-footer" style="text-align: center;">
        <button type="button" class="btn btn-primary">Зарегистрироваться</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $this->registerJs("$('.modal').modal('show');"); ?>
<?php Yii::$app->response->cookies->add(new yii\web\Cookie(['name' => 'first', 'value' => '1'])) ?>
<?php endif; ?>

