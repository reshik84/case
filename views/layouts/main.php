<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\MainAsset;

MainAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div id="flare"><div id="wrapper">
                <header>
                    <div id="smart-icons" class="smart-icons"></div>
                    <div id="search" class="search"></div>
                    <?php
                    NavBar::begin([
                        'brandLabel' => Html::img('/images/logo.png'),
                        'brandUrl' => Yii::$app->homeUrl,
                        'options' => [
                            'class' => 'navbar-inverse navbar-fixed-top',
                        ],
                    ]);
                    echo Nav::widget([
                        'options' => ['class' => 'navbar-nav navbar-right'],
                        'items' => [
                                ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
//                                ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']],
//                                ['label' => Yii::t('app', 'FAQ'), 'url' => ['/faq']],
                                ['label' => Yii::t('app', 'Login'), 'url' => ['/user/security/login'], 'visible' => Yii::$app->user->isGuest],
                                ['label' => Yii::t('app', 'Register'), 'url' => ['/user/registration/register'], 'visible' => Yii::$app->user->isGuest],
//                                ['label' => Yii::$app->user->identity->username . ' (' . Yii::$app->user->identity->balance . ' руб)', 'url' => ['/user/settings'], 'visible' => !Yii::$app->user->isGuest],
                            Yii::$app->user->isGuest ? (''):(
                            '<li>' . Html::a(Yii::$app->user->identity->username . ' (<span id="bal">' . Yii::$app->formatter->asInteger(Yii::$app->user->identity->balance) . '</span> руб)', ['/user/settings/account']) . '</li>'),
                            Yii::$app->user->isGuest ? (
                                    ''
                                    ) : (
                                    '<li>' . Html::beginForm(['/user/security/logout'], 'post')
                                    . Html::submitButton(
                                            Yii::t('app', 'Logout'), ['class' => 'btn btn-link logout']
                                    )
                                    . Html::endForm()
                                    . '</li>'
                                    )
                        ],
                    ]);
                    NavBar::end();
                    ?>
                </header>
                <div id="colswrp">

                    <div id="column2">
                        <main>
                            <div class="container-fluid">
                            <?= $content ?>
                            </div>
                        </main>
                    </div>
                </div>
                <footer class="footer">
                     <?php
                    NavBar::begin([
                        'brandLabel' => '<p class="pull-left">&copy; case-opener.com ' . date('Y') .
                        '<a href="//www.free-kassa.com/" class="fk" ><img src="//www.free-kassa.ru/img/fk_btn/15.png"></a>
                        </p>',
                        'brandUrl' => Yii::$app->homeUrl,
                        'options' => [
                            'class' => 'navbar-inverse',
                        ],
                    ]);
                    echo Nav::widget([
                        'options' => ['class' => 'navbar-nav navbar-right'],
                        'items' => [
//                                ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']],
                                ['label' => 'Пользовательское соглашение', 'url' => ['/site/rules']],
                        ],
                    ]);
                    NavBar::end();
                    ?>
                </footer>
            </div></div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
