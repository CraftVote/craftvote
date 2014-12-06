<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Password
 *
 * @author ishibkikh
 */
namespace System;

class Password
{
    
    static public function hash($plain)
    {
        return password_hash($plain, PASSWORD_BCRYPT);
        //return \System\Hasher::gen256($plain);
    }
    
    
    static public function verify($plain, $hash)
    {
        return password_verify($plain, $hash);
        //return (\System\Hasher::gen256($plain) === $hash);
    }
}
