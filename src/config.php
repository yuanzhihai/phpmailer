<?php

return [
    'mailer' => [
        'default' => [
            'host'        => 'smtp.qq.com',
            'username'    => '',
            'sendName'    => '',
            'password'    => '',
            'charset'     => 'UTF-8', //编码格式
            'smtp_auth'   => true,  //开启SMTP验证
            'is_html'     => true,
            'smtp_secure' => 'ssl',  // 开启TLS 可选
            'port'        => 465, //端口
            'debug'       => 0, //调式模式
        ],
    ]
];
