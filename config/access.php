<?php
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;

return [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                        [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ];