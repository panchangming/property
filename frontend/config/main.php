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
    'controllerNamespace' => 'frontend\controllers',
    'language'            => 'zh-CN',
    'defaultRoute'=>'index/index',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'frontend\models\member',
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'api/getYourFav'=>'api/getyourfav',
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport'=>false,//false表示发送邮件，否则不发送只保存到本地
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.163.com',//邮件服务器地址163: smtp.163.com   qq:smtp.qq.com
                'username' => '18784352027@163.com',//abc@163.com   abc@qq.com
                'password' => 'pcm276412981',//123456     123456
                'port' => '25',//163：25或465或587   QQ:465或587
                'encryption' => 'tls',
            ],
        ],

    ],
    'params' => $params,
];
