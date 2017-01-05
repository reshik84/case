    <?php foreach ($opers as $oper): ?>
    <div class="win">
        <p><?= $oper->user->username ?></p>
        <p><?= Yii::$app->formatter->asInteger($oper->sum) ?> р.</p>
    </div>
    <?php endforeach; ?>