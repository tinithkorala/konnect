<?php

namespace Core;

use Config\Config;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

class Mailer
{
    protected static $_mailer;
    protected PHPMailer $mail_handler;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->mail_handler = new PHPMailer(true); //passing true to enable exceptions
        $this->mail_handler->SMTPDebug = SMTP::DEBUG_SERVER;
        $this->mail_handler->isSMTP();
        $this->mail_handler->Host = Config::get('smtp-host');
        $this->mail_handler->Username = Config::get('smtp-email');
        $this->mail_handler->Password = Config::get('smtp-password');
        $this->mail_handler->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail_handler->Port = Config::get('smtp-port');
        try {
            $this->mail_handler->setFrom('konnect-admin@gmail.com', 'Konnect Admin');
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public static function getMailInstance()
    {
        if (!self::$_mailer) {
            try {
                self::$_mailer = new self();
            } catch (Exception $exception) {
                Session::message($exception->getMessage(), "warning", "Mailer connection failed");
            }
        }
        if (self::$_mailer) return self::$_mailer;
        else return false;
    }

    public function sendMail($subject, $body, $recipients)
    {
        $success = 0;
        foreach ($recipients as $recipient) {
            try {
                $this->mail_handler->addAddress($recipient['email'], $recipient['name']);
                $this->mail_handler->Subject = $subject;
                $this->mail_handler->Body = $body;
                $this->mail_handler->send();
                $success = $success + 1;
            } catch (Exception $exception) {
                Session::message("Mailer error {$exception}", "warning", "Error");
            }
            $this->mail_handler->clearAddresses();
        }
        return $success;
    }
}