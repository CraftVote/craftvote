<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace System;

/**
 * Description of MCrypt
 *
 * @author Ivan
 */
class MCrypt {
    
    const
        TYPE = MCRYPT_BLOWFISH,
        BASE64 = true;
    
    static public function encode($plain, $key)
    {
        $iv_size = mcrypt_get_iv_size(self::TYPE, MCRYPT_MODE_CBC);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $ciphertext = mcrypt_encrypt(self::TYPE, $key, $plain, MCRYPT_MODE_CBC, $iv);
        if (self::BASE64){
            $ciphertext = base64_encode($iv . $ciphertext);
        }
        else{
            $ciphertext = $iv . $ciphertext;
        }
        return $ciphertext;
    }
    
    static public function decode($cipher, $key)
    {
        if (self::BASE64){
            $ciphertext_dec = base64_decode($cipher);
        }
        else{
            $ciphertext_dec = $cipher;
        }
        $iv_size = mcrypt_get_iv_size(self::TYPE, MCRYPT_MODE_CBC);
        $iv_dec = substr($ciphertext_dec, 0, $iv_size);
        $ciphertext_dec = substr($ciphertext_dec, $iv_size);
        return mcrypt_decrypt(self::TYPE, $key, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);
    }
}
