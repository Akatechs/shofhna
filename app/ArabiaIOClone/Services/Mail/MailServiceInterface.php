<?php
namespace ArabiaIOClone\Services\Mail;

/**
 *
 * @author mhamed
 */
interface MailServiceInterface 
{
    public function sendAccountRegisterEmail(  $to, $link,$username);
    public function sendRecoverPasswordEmail($to,  $username,$password,$link);
    public function sendNotificationToAdmin($data);
}
