<?php
class PHPMailer
{
    public function __construct()
    {
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load()
    {
        require_once(APPPATH."third_party/phpmailer/src/PHPMailer.php");
        require_once(APPPATH."third_party/phpmailer/src/SMTP.php");
        require_once(APPPATH."third_party/phpmailer/src/Exception.php");
        $objMail = new PHPMailer\PHPMailer\PHPMailer();
        return $objMail;
    }
}