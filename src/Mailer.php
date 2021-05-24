<?php

namespace yzh52521\PHPMailer;

/**
 * Mailer
 * @see \yzh52521\PHPMailer\Mailer
 * @package \yzh52521\PHPMailer\Mailer
 * @mixin \yzh52521\PHPMailer\service\Mailer
 * @method static Mailer init() 初始化
 * @method  Mailer setSender($address, $senderName = '') 设置发送人
 * @method  Mailer setReplyAddress($address = '', $replayName = '') 设置收件人回复地址
 * @method  Mailer setAddressee($address, $recName = '') 设置单个接收人
 * @method  Mailer  setManyAddressee($array) 设置多个接收人
 * @method  Mailer  setCC($address = '', $name = '') 设置抄送单个接收人
 * @method  Mailer setManyCC($array) 设置抄送多个接收人
 * @method  Mailer  setBCC($address = '', $name = '') 设置暗抄送单个接收人
 * @method  Mailer setManyBCC($array) 设置暗抄送多个接收人
 * @method  Mailer setAttachment($filename, $name = '') 设置单个附件
 * @method  Mailer setManyAttachment($array) 设置多个附件
 * @method  Mailer  setContent($title = '', $body = '', $altBody = '') 设置邮件内容
 * @method  send() 发送邮件
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
