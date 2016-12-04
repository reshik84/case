<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var yii\widgets\ActiveForm      $form
 * @var dektrium\user\models\User   $user
 */
?>

<?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>
<?php if($user->scenario == 'update'): ?>
    <?= $form->field($user, 'balance')->textInput(['maxlength' => 255]) ?>
<?php endif; ?>
<?= $form->field($user, 'username')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'password')->passwordInput() ?>
<?= $form->field($user, 'role')->dropDownList(['user' => Yii::t('app', 'User'), 'admin' => Yii::t('app', 'Admin')]) ?>
