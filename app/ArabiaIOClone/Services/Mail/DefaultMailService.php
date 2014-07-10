<?php



namespace ArabiaIOClone\Services\Mail;



use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;
/**
 * Description of DefaultMailService
 *
 * @author mhamed
 */
class DefaultMailService implements MailServiceInterface 
{
    protected function addHeaders($message)
    {
        
        
        $message->getHeaders()->addTextHeader('MIME-Version', '1.0');
        $message->getHeaders()->addTextHeader('Content-type', 'text/html charset=utf-8');
        $message->getHeaders()->addTextHeader('From', 'noreply@shofhna.com');
        $message->getHeaders()->addTextHeader('Disposition-Notification-To', 'noreply@shofhna.com');
        $message->getHeaders()->addTextHeader('X-Priority', '1');
        $message->getHeaders()->addTextHeader('X-MSMail-Priority', 'High');

        return $message;
    }
    
    public function  sendNotificationToAdmin($data)
    {
        
    }
    
    
    public function sendAccountRegisterEmail(   $to,
                                                $link,
                                                $username
                                                )
    {
        Mail::send('emails.auth.activateAccount',[ 'link' => $link,'username'=>$username ],
                                function($message) use($username,$to){
                                    $message->to($to,$username)->subject(Lang::get('reminders.activationEmailTitle'));
                                    $message = $this->addHeaders($message);
                                }
                            );
    }
    
    public function sendRecoverPasswordEmail(   $to, 
                                                $username,
                                                $password,
                                                $link)
    {
        Mail::send('emails.auth.recoverPassword',[
                    'link'=> $link,
                    'username'=> $username,
                    'password'=> $password],
                        function($message) use ($to,$username ){
                            $message->to($to,$username)
                                    ->subject(Lang::get('reminders.recoverPasswordEmailTitle'));
                            $message = $this->addHeaders($message);
                    });
    }

//put your code here
}
