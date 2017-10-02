<?php
\Cloudinary::config(array(
    "cloud_name" => "ddw31jew8",
    "api_key" => "579645943766338",
    "api_secret" => "BiQsP-Py8lbfj7tnVGjgdIa67WI"
));
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ]
    ],
];
