<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    // set target language to be Russian
    'language' => 'ru-RU',
    
    // set source language to be English
    'sourceLanguage' => 'en-US',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
			'enableCookieValidation' => true,
			'enableCsrfValidation' => true,
            'cookieValidationKey' => md5('test.local'),
			'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
		'authManager' => [
            'class' => 'yii\rbac\DbManager',
			'defaultRoles' => ['admin', 'member', 'guest'],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
		
        'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			/*
			'rules' => [
				'' => 'site/index',
				'<action>'=>'site/<action>',
			],
			*/
		],
        
    ],
	'modules' => [
		'cpanel' => [
			'class' => 'app\modules\cpanel\Module',
			'as access' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        // 'roles' => ['admin']
                    ],
                ]
            ],
		],
	],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
		'allowedIPs' => ['127.0.0.1']
    ];
}

return $config;
