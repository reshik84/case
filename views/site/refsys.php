<?php

/* @var $this yii\web\View */

$this->title = 'Партнерская программа | case-opener.com';

?>

<h2>Партнерская программа</h2>
<p>Пригласите друзей и зарабатывайте на их ставках.</p>
<table>
    <tr>
        <td>1 уровень</td>
        <td>7%</td>
    </tr>
    <tr>
        <td>2 уровень</td>
        <td>5%</td>
    </tr>
    <tr>
        <td>3 уровень</td>
        <td>3%</td>
    </tr>
    <tr>
        <td>4 уровень</td>
        <td>1%</td>
    </tr>
</table>
<?php if(!Yii::$app->user->isGuest): ?>
<div>
    <label>Ваша реферальная ссылка</label>
    <input type="text" value="<?= Yii::$app->urlManager->createAbsoluteUrl(['/', 'ref' => Yii::$app->user->identity->username]) ?>" onclick="this.select()" readonly="true" />
</div>
<?php endif; ?>