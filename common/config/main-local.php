<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
//             'dsn' => 'mysql:host=localhost;dbname=wechat_uniauto',
//             'username' => 'root',
//             'password' => 'kyuuchou',
                   
            'dsn' => 'mysql:host=192.168.80.30;dbname=jn_wechat',
            'username' => 'root',
            'password' => 'mysql@123',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
