<?php

namespace ArabiaIOClone\Services\Mail;

use Bogardo\Mailgun\Facades\Mailgun;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;



/**
 * Description of MailService
 *
 * @author mhamed
 */
class MailgunService implements MailServiceInterface
{
    
    
    
    public function __construct()
    {
        
    }
    
    protected function addHeaders($message)
    {
        
        
        $message->data('MIME-Version', '1.0');
        $message->data('Content-type', 'text/html charset=utf-8');
        $message->data('From', 'noreply@shofhna.com');
        $message->data('Disposition-Notification-To', 'noreply@shofhna.com');
        $message->data('X-Priority', '1');
        $message->data('X-MSMail-Priority', 'High');

        return $message;
    }
    
    
    public function sendAccountRegisterEmail(   $to,
                                                $link,
                                                $username
                                                )
    {
        Mailgun::send('emails.auth.activateAccount',[ 'link' => $link,'username'=>$username ],
                                function($message) use($username,$to){
                                    $message->to($to,$username)->subject(Lang::get('reminders.activationEmailTitle'));
                                    $message = $this->addHeaders($message);
                                }
                            );
    }
    
    public function  sendNotificationToAdmin($data)
    {
        Mailgun::send('emails.adminNotification',['data'=> $data],
                        function($message) {
                            $message->to(Config::get('config.global.admin_email'))
                                    ->subject(Lang::get('Notification To admin'));
                            $message = $this->addHeaders($message);
                    });
    }
    
    public function sendRecoverPasswordEmail(   $to, 
                                                $username,
                                                $password,
                                                $link)
    {
        Mailgun::send('emails.auth.recoverPassword',[
                    'link'=> $link,
                    'username'=> $username,
                    'password'=> $password],
                        function($message) use ($to,$username ){
                            $message->to($to,$username)
                                    ->subject(Lang::get('reminders.recoverPasswordEmailTitle'));
                            $message = $this->addHeaders($message);
                    });
    }
}
