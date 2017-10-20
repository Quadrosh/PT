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
//            'bundles' => [
//                'yii\web\JqueryAsset' => [
//                    'sourcePath' => null,   // do not publish the bundle
//                    'js' => [
////                        '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js',
//                        '//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js',
//                    ]
//                ],
//            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'cookieValidationKey' => 'DgaujypcSnGWPqwdtwTo'
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
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'article/<hrurl:[0-9a-z\-\_]+>' => 'article/view',
                'article/bytag/<hrurl:[0-9a-z\-\_]+>' => 'article/bytag',
                'article/bypsy/<hrurl:[0-9a-z\-\_]+>' => 'article/bypsy',

                'master/index' => 'master/index',
                'master/<hrurl:[0-9a-z\-\_]+>' => 'master/view',
                'master/<hrurl:[0-9a-z\-\_]+>/<article:[0-9a-z\-\_]+>' => 'master/view',
                'master/otziv/<hrurl:[0-9a-z\-\_]+>' => 'master/reviews',
                'master/read/<article:[0-9a-z\-\_]+>' => 'master/read',
                'master/go/<hrurl:[0-9a-z\-\_]+>' => 'master/order',
                'master/<hrurl:[0-9a-z\-\_]+>/otziv' => 'master/reviews',

            ],
        ],

    ],
    'params' => $params,
];
