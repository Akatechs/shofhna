<?php



namespace ArabiaIOClone\Providers;

use Illuminate\Support\ServiceProvider;
use ArabiaIOClone\Services\Mail\MailgunService;
/**
 * Description of MailServiceProvider
 *
 * @author mhamed
 */
class MailServiceProvider extends ServiceProvider
{
    public function register() 
    {
        $this->app->bind(
            'ArabiaIOClone\Services\Mail\MailServiceInterface',
            'ArabiaIOClone\Services\Mail\MailgunService'
        );
        $this->app['service.mail'] = $this->app->share(function ($app) {
            return $this->app->make('ArabiaIOClone\Services\Mail\MailServiceInterface');
        });
    }

//put your code here
}
