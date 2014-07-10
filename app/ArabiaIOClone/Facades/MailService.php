<?php
namespace ArabiaIOClone\Facades;
use Illuminate\Support\Facades\Facade;



/**
 * Description of MailService
 *
 * @author mhamed
 */
class MailService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'service.mail';
    }
}
