<?php

namespace yzh52521\PHPMailer;

/**
 * Mailer
 * @see \yzh52521\PHPMailer\Mailer
 * @package \yzh52521\PHPMailer\Mailer
 * @mixin \yzh52521\PHPMailer\service\Mailer
 * @method static \yzh52521\PHPMailer\service\Mailer create() 创建邮件类
 * @method static \yzh52521\PHPMailer\service\Mailer setSender($address, $senderName = '') 设置发送人
 * @method static \yzh52521\PHPMailer\service\Mailer setReplyAddress($address = '', $replayName = '') 设置收件人回复地址
 * @method static \yzh52521\PHPMailer\service\Mailer setAddressee($address, $recName = '') 设置单个接收人
 * @method static \yzh52521\PHPMailer\service\Mailer  setManyAddressee($array) 设置多个接收人
 * @method static \yzh52521\PHPMailer\service\Mailer  setCC($address = '', $name = '') 设置抄送单个接收人
 * @method static \yzh52521\PHPMailer\service\Mailer setManyCC($array) 设置抄送多个接收人
 * @method static \yzh52521\PHPMailer\service\Mailer  setBCC($address = '', $name = '') 设置暗抄送单个接收人
 * @method static \yzh52521\PHPMailer\service\Mailer setManyBCC($array) 设置暗抄送多个接收人
 * @method static \yzh52521\PHPMailer\service\Mailer setAttachment($filename, $name = '') 设置单个附件
 * @method static \yzh52521\PHPMailer\service\Mailer setManyAttachment($array) 设置多个附件
 * @method static \yzh52521\PHPMailer\service\Mailer  setContent($title = '', $body = '', $altBody = '') 设置邮件内容
 * @method static \yzh52521\PHPMailer\service\Mailer send() 发送邮件
 */
class Mailer
{
    /**
     * 静态魔术方法
     * @param $method
     * @param $args
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        $config = config('phpmailer.mailer.default');
        $model  = new \yzh52521\PHPMailer\service\Mailer(app(), $config);

        return call_user_func_array([$model, $method], $args);
    }

}
