<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class MlyalinaAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'libs/slick/slick.css',
        'css/common/article.css',
        'css/m_lyalina2.css',
    ];
    public $js = [
        'libs/slick/slick.min.js',
        'js/common/article.js',
        'js/m_lyalina.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',

    ];
}
