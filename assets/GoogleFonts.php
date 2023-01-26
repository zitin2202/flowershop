<?php

namespace app\assets;

use yii\web\AssetBundle;

class GoogleFonts extends  AssetBundle
{
    public $sourcePath = '@bower/font-awesome';
    public $css = [
    ];


    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}