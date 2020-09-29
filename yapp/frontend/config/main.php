<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'name' => 'Психотера',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'assetManager' => [
            'assetMap' => [
                'jquery.js' => '//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js',
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
//            'cookieValidationKey' => $params['cookieValidationKey'],  // main-local
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'categories' => ['psihoteraOrderBot'],
                    'logFile' => '@runtime/logs/psihoteraOrderBot.log',
                    'logVars' => [],   // $_GET, $_POST, $_FILES, $_COOKIE, $_SESSION, $_SERVER
                    'maxFileSize' => 1024 * 2,
                    'maxLogFiles' => 20,
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'categories' => ['liveThroughBot'],
                    'logFile' => '@runtime/bots/livethroughbot/logs/livethroughbot.log',
                    'logVars' => [],   // $_GET, $_POST, $_FILES, $_COOKIE, $_SESSION, $_SERVER
                    'maxFileSize' => 1024 * 2,
                    'maxLogFiles' => 20,
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                $params['ptOrderTGBotPath']=>'notification/telegin',
                $params['lTTGBotPath']=>'live-through/dialog',

                'img/view/<name:([A-Za-z0-9\.\-\_])+>' => 'site/get-image', // картинки - создание на лету если файла нет
                '<hrurl:uslugi-psihoterapevtu>' => 'article/page', // services-to-master
                '<hrurl:disclaimer>' => 'article/page', // services-to-master

                'article/search' => 'article/search',
                'article/<hrurl:[0-9a-z\-\_]+>' => 'article/view',
                'article/bytag/<hrurl:[0-9a-z\-\_]+>' => 'article/bytag',
                'article/bypsy/<hrurl:[0-9a-z\-\_]+>' => 'article/bypsy',

                '<hrurl:she>' => 'article/master-page',
                '<hrurl:she/about>' => 'article/master-page',
                '<hrurl:she/contact>' => 'article/master-page',

                '<root:lyalina>' => 'article/premium-master-page',
                '<root:lyalina>/<page:[0-9a-z\-\_]+>' => 'article/premium-master-page',



                'master/filter' => 'master/filter',
                'master/index' => 'master/index',
                'master/search' => 'master/search',
                'master/<hrurl:[0-9a-z\-\_]+>' => 'master/view',
                'master/<hrurl:[0-9a-z\-\_]+>/<article:[0-9a-z\-\_]+>' => 'master/view',
//                'master/otziv/<hrurl:[0-9a-z\-\_]+>' => 'master/reviews',
//                'master/read/<article:[0-9a-z\-\_]+>' => 'master/read',
//                'master/go/<hrurl:[0-9a-z\-\_]+>' => 'master/order',
//                'master/<hrurl:[0-9a-z\-\_]+>/otziv' => 'master/reviews',


            ],
        ],

    ],
    'params' => $params,
];
