<?php

/*
 * This file is part of the Dektrium project
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\bootstrap\Nav;

?>

<?= Nav::widget([
    'options' => [
        'class' => 'nav-tabs',
        'style' => 'margin-bottom: 15px',
    ],
    'items' => [
        [
            'label'   => Yii::t('app', 'Operations'),
            'url'     => ['/operations/admin/index'],
        ],
        [
            'label' => Yii::t('app', 'Create'),
            'items' => [
                [
                    'label'   => Yii::t('app', 'New operation'),
                    'url'     => ['/operations/admin/create'],
                ],
            ],
        ],
    ],
]) ?>
