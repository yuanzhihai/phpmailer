# PHPMailer
thinkphp6 mail扩展类库，基于PHPMailer的邮件发送。

## 安装和配置
修改项目下的composer.json文件，并添加：
```
    "yzh52521/phpmailer":"dev-main"
```
然后执行```composer update```

安装成功后，添加以下配置到./config/phpmailer.php文件：
```php
    'mailer' => array(
        'default' => array(
            'host'        => 'smtp.qq.com',
            'username'    => '',
            'password'    => '',
            'charset'     => 'UTF-8', //编码格式
            'smtp_auth'   => true,  //开启SMTP验证
            'is_html'     => true,
            'smtp_secure' => 'ssl',  // 开启TLS 可选
            'port'        => 465, //端口
            'debug'       => 0, //调式模式
        ),
    ),
```


## 使用
如下代码示例：
```php

  $mail = \yzh52521\PHPMailer\Mailer::init()
      ->setSender('xxxxx@qq.com','发送者')//发送人
      ->setManyCC(['jjj@163.com'])//抄送
      ->setContent('我是标题','<h2>我是内容</h2>')
      ->send();
```
