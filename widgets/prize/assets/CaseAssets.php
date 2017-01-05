<?php

namespace app\widgets\prize\assets;

use yii\web\AssetBundle;

class CaseAssets extends AssetBundle {
    
    public $sourcePath = '@app/widgets/prize/js';
    
    public $js = [
        'prize.js'
    ];
    
    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];
    
    public $depends = [
        'app\assets\MainAsset'
    ];
    
}
