<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '03Tky_w7bgT-J6X9eD5d6rx2YiXIrvrM',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
                
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages', // if advanced application, set @frontend/messages
                    'sourceLanguage' => 'es_ES',
                    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
            ],
            
        ],
        
        /************** Componente interoperable *************/
        'lugar'=> [
            'class' => $params['servicioLugar'],//'app\components\ServicioLugar'
        ],
        /************* Fin Componente interoperable *************/
        
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\ApiUser',
            'enableSession' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                [   
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'categoria'
                ],
                [   
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'comprobante',
                    'extraPatterns' => [
                        'PUT registrar-producto-faltante/{id}' => 'registrar-producto-faltante',
                        'OPTIONS registrar-producto-faltante/{id}' => 'registrar-producto-faltante',
                        'PUT registrar-producto-pendiente/{id}' => 'registrar-producto-pendiente',
                        'OPTIONS registrar-producto-pendiente/{id}' => 'registrar-producto-pendiente',
                    ], 
                ],
                [   
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'deposito'
                ],
                [   
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'egreso'
                ],
                [   
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'inventario'
                ],
                [   
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'marca'
                ],
                [   
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'producto',
                    'extraPatterns' => [
                        'PUT set-activo/{id}' => 'set-activo',
                        'OPTIONS set-activo/{id}' => 'set-activo',
                    ],
                ],
                [   
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'proveedor'
                ],
                [   
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'unidad-medida'
                ],
                /****** USUARIOS *******/
                [   
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'usuario',   
                    'extraPatterns' => [
                        'POST login' => 'login',
                        'OPTIONS login' => 'options'
                        //'GET mostrar/{id}' => 'mostrar',
                    ],          
                ],
                ##### Interoperabilidad con Lugar#####
                [   #Localidad
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'localidad', 
                ],
            ]
        ],
    ],
    
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableConfirmation'=>false,
            'admins'=>['admin']
        ]
    ],
    
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}

return $config;
