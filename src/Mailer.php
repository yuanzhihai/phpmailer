<?php

namespace yzh52521\PHPMailer;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    public $options = [];
    protected $addressee = [];
    protected $sender = [];
    protected $cc = [];
    protected $bcc = [];
    protected $attachment = [];
    protected $title = '';
    protected $body = '';
    protected $altBody = '';
    protected $mail = null;
    protected $app;

    public function __construct($app = null, $configs = [])
    {
        if (is_array($configs)) {
            $this->options = array_merge($this->options, $configs);
        }
        $this->app  = $app ?: app();
        $this->mail = new PHPMailer(true);
    }

    /**
     * 初始化参数
     */
    public function init()
    {
        $this->mail->SMTPDebug  = $this->options['debug'];
        $this->mail->Host       = $this->options['host'];
        $this->mail->CharSet    = $this->options['charset'];
        $this->mail->SMTPAuth   = $this->options['smtp_auth'];
        $this->mail->Username   = $this->options['username'];
        $this->mail->Password   = $this->options['password'];
        $this->mail->SMTPSecure = $this->options['smtp_secure'];
        $this->mail->Port       = $this->options['port'];
        $this->mail->isHTML($this->options['is_html']);
    }

    //设置发送人
    public function setSender($address, $senderName = '')
    {
        $this->sender['a'] = $address;
        $this->sender['n'] = $senderName;
    }

    //设置收件人回复的地址
    public function setReplyAddress($address = '', $replayName = '')
    {
        $this->sender['a'] = $address;
        $this->sender['n'] = $replayName;
    }

    /**
     * 设置单个接收人
     * @param $address
     * @param string $recName
     */
    public function setAddressee($address, $recName = '')
    {
        $this->setAddress('addressee', $address, $recName);
    }

    /**
     * 设置多个接收人
     * @param $array
     */
    public function setManyAddressee($array)
    {
        array_walk(
            $array,
            function ($v) {
                $this->setAddressee($v);
            }
        );
    }

    /**
     * 设置抄送单个接收人
     * @param string $address
     * @param string $name
     */
    public function setCC($address = '', $name = '')
    {
        $this->setAddress('cc', $address, $name);
    }

    /**
     * 设置抄送多个接收人
     * @param $array
     */
    public function setManyCC($array)
    {
        array_walk(
            $array,
            function ($v) {
                $this->setCC($v);
            }
        );
    }

    /**
     * 设置暗抄送单个接收人
     * @param string $address
     * @param string $name
     */
    public function setBCC($address = '', $name = '')
    {
        $this->setAddress('bcc', $address, $name);
    }

    /**
     * 设置暗抄送多个接收人
     * @param $array
     */
    public function setManyBCC($array)
    {
        array_walk(
            $array,
            function ($v) {
                $this->setBCC($v);
            }
        );
    }

    /**
     * 设置单个附件
     * @param $address
     * @param string $newName
     */
    public function setAttachment($address, $newName = '')
    {
        $this->setAddress('attachment', $address, $newName);
    }

    /**
     * 设置多个附件
     * @param $array
     */
    public function setManyAttachment($array)
    {
        array_walk(
            $array,
            function ($v) {
                $this->setAttachment($v);
            }
        );
    }

    protected function setAddress($param, $address, $name)
    {
        $this->{$param}[] = [
            'a' => $address,
            'n' => $name
        ];
    }

    /**
     * 设置邮件内容
     * @param string $title
     * @param string $body
     * @param string $altBody
     */
    public function setContent($title = '', $body = '', $altBody = '')
    {
        $this->title   = $title;
        $this->body    = $body;
        $this->altBody = $altBody;
    }

    /**
     * 发送
     * @return array|bool
     * @throws Exception
     */
    public function send()
    {
        $this->mail->isSMTP();
        $this->init();
        $this->mail->setFrom($this->sender['a'], $this->sender['n']);
        $this->mail->addReplyTo($this->sender['a'], $this->sender['n']);

        $this->addAddress($this->addressee, 'addAddress');
        $this->addAddress($this->bcc, 'addBCC');
        $this->addAddress($this->cc, 'addCC');
        $this->addAddress($this->attachment, 'addAttachment');

        $this->mail->Subject = $this->title;
        $this->mail->Body    = $this->body;
        $this->mail->AltBody = $this->altBody;
        if (!$this->mail->send()) {
            if ($this->options['debug']) {
                $this->app->log->debug('Fail to send email with error: ' . $this->mail->ErrorInfo);
            }
        }
        if ($this->options['debug']) {
            $this->app->log->debug(
                'Succeed to send email',
                ['addresses' => $this->addressee, 'title' => $this->title]
            );
        }
    }

    public function addAddress($address, $func)
    {
        foreach ($address as $item) {
            $item['a'] && $this->mail->{$func}($item['a'], $item['n']);
        }
    }

}
