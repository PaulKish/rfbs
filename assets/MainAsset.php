<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap-simplex.beautified.css',
        'https://cdnjs.cloudflare.com/ajax/libs/TableExport/3.2.5/css/tableexport.min.css',
        'css/site.css',
    ];
    public $js = [
        'js/vendor/modernizr-2.8.3-respond-1.4.2.min.js',
        'js/plugins.js',
        'js/vendor/xlsx.core.min.js',
        'js/vendor/FileSaver.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/TableExport/3.3.5/js/tableexport.min.js',
        'https://use.fontawesome.com/407cfa70c8.js',
        'js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset'
    ];

    public function init()
    {
        parent::init();
        // resetting BootstrapAsset to not load own css files
        \Yii::$app->assetManager->bundles['yii\\bootstrap\\BootstrapAsset'] = [
            'css' => []
        ];
    }
}
