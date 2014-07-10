<?php


namespace ArabiaIOClone\Helpers;

/**
 * Description of ShortLink
 *
 * @author Admin
 */
class ShortLink 
{
    static public function EncryptId($idAsInteger)
    {
        return bin2hex("$idAsInteger");
    }
    
    static public function DecryptId($idAsString)
    {
        return hex2bin($idAsString);
    }
}
