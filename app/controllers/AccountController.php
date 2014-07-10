<?php

use ArabiaIOClone\Facades\MailService;


/**
 * Description of AccountController
 *
 * @author Hichem MHAMED
 */
class AccountController extends BaseController
{
    
    public function getTwitterLogin() {
        // get data from input
        $code = Input::get('oauth_token');
        $oauth_verifier = Input::get('oauth_verifier');
        OAuth::setHttpClient("CurlClient");
        $twitterService = OAuth::consumer('Twitter');
        if (!empty($code)) {
             
            $token = $twitterService->getStorage()->retrieveAccessToken('Twitter');
            $twitterService->requestAccessToken($code, $oauth_verifier, $token->getRequestTokenSecret());
            $result = json_decode($twitterService->request('account/verify_credentials.json'));
            $user = $this->users->findByTwitterId($result->id);
            
            if ($user) {
                Auth::login($user);
                return  Redirect::intended(route('default'));
            } else 
            {
                $user = $this->users->createFromTwitter($result);
                if($user)
                {
                    MailService::sendAccountRegisterByTwitterNotificationToAdmin($user->username);
                    Auth::login($user);
                    return Redirect::intended(route('default'))
                        ->with('success',[Lang::get('success.account_activated')]);
                }else
                {
                    return Redirect::intended(route('account-login'))
                        ->withErrors(Lang::get('errors.account_activated'));
                }   
            }
        }
        else {

            $token = $twitterService->requestRequestToken();
            $url = $twitterService->getAuthorizationUri(['oauth_token' => $token->getRequestToken()]);
            return Redirect::secure((string) $url);

        }
    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::route('default');
    }
    
    public function getIndex()
    {
        return View::make('account.index');
    }
    
    
    
    public function postLogin()
    {
        $loginForm = $this->users->getLoginForm();
        
        // 1. validator fails
        if (!$loginForm->isValid())
        {
            return  Redirect::route('account-login')
                ->withErrors($loginForm->getErrors());
        }
        
        
        $credentials = Input::only([ 'username', 'password' ]);
        //$remember = Input::get('remember', false);
        $remember = true;

        if (str_contains($credentials['username'], '@')) 
        {
            $credentials['email'] = $credentials['username'];
            unset($credentials['username']);
        }else
        {
            $userByUsername = $this->users->findByUsername($credentials['username']);
            if($userByUsername)
            {
                $credentials['email'] = $userByUsername->email;
            }else
            {
                return Redirect::route('account-login')
                        ->withInput()
                        ->withErrors(Lang::get('errors.login_wrong_credentials'));
            }
        }
        
        $attempt = Auth::attempt(array(
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'active' => 1),true);
        
        if ($attempt) 
        {
            return Redirect::intended(route('default'));
        }
        
        return Redirect::route('account-login')
                    ->withInput()
                    ->withErrors(Lang::get('errors.login_wrong_credentials'));
    }
    
    public function getActivate($code)
    {
        $user = $this->users->findByActivationCode($code);
        if($user)
        {
            if($this->users->setActivated($user))
            {
                Auth::login($user);
                return Redirect::route('user-index',$user->username)
                        ->with('success',[Lang::get('success.account_activated')]);
            }
        }
        
        return Redirect::route('default')
                        ->withErrors(Lang::get('errors.account_activated'));
        
        
    }
    
    public function getRecoverPassword($code)
    {
        $user = $this->users->findByActivationCodeAndTempPassword($code);
        if ($user)
        {
            if($this->users->setRecoverPasswordCompleteState($user))
            {
                return Redirect::route('default')
                        ->with('success',[Lang::get('success.account_recover_password')]);
            }
        }
        return Redirect::route('account-login')
                ->withErrors([Lang::get('errors.account_recover_password')]);
    }
    
    
    public function postRecoverPassword()
    {
        $recoverPasswordForm = $this->users->getRecoverPasswordForm();
        if(!$recoverPasswordForm->isValid())
        {
            return Redirect::route('account-login')
                ->withInput()
                ->withErrors($recoverPasswordForm->getErrors());
        }
        $data = $recoverPasswordForm->getInputData();
        $email = $data['email'];
        $user = $this->users->findByEmail($email);
        if($user && ($user->twitter_id == null))
        {
            if($this->users->setRecoverPasswordRequestState($user))
            {
                MailService::sendRecoverPasswordEmail($user->email,$user->username,$user->password_temp,URL::route('account-recover-password',[$user->code]));
                return Redirect::route('account-login')
                    ->with('success',[Lang::get('success.account_recover_password_request_sent')]);
            

            }
        }else
        {
            return Redirect::route('account-login')
                        ->withErrors(Lang::get('errors.account_email_notfound'))
                        ->withInput();
        }
        
    }
    
    public function postCreate()
    {
        
                        
        $accountCreateForm = $this->users->getAccountCreateForm();
        if (!$accountCreateForm->isValid())
        {
            return Redirect::route('account-register')
                ->withInput()
                ->withErrors($accountCreateForm->getErrors());
        }else 
        {
            if($user = $this->users->create($accountCreateForm->getInputData()))
            {
                MailService::sendAccountRegisterEmail($user->email,URL::route('account-activate',$user->code),$user->username);
//                Mail::send('emails.auth.activateAccount',[ 'link' => URL::route('account-activate',$user->code),'username'=>$user->username ],
//                                function($message) use($user){
//                                    $message->to($user->email,$user->username)->subject(Lang::get('reminders.activationEmailTitle'));
//                                }
//                            );
                return Redirect::route('default')
                    ->with('success',[Lang::get('success.account_register_email_sent')]);
            }
        }
        
    }


}

?>
