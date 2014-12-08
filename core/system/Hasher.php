<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace System;

/**
 * Description of Hasher
 *
 * @author ishibkikh
 */
class Hasher {
    
    static public function gen256($plain){
        return hash('sha256', $plain, false);
    }
    
    static public function gen32($plain){
        return hash('ripemd160', $plain);
    }
    
    static public function gen512($plain){
        return hash('sha512', $plain, false);
    }
    
    static public function genRandom($size){
        $chars = 'abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ23456789';
        $chars_siz = strlen($chars)-1;
        $hash = null;
        while($size--){
            $hash.=$chars[rand(0,$chars_siz)];
        }
        
        return $hash;
    }
    
    static public function genRandomNum($size){
        $chars = '0123456789';
        $chars_siz = strlen($chars)-1;
        $hash = null;
        while($size--){
            $hash.=$chars[rand(0,$chars_siz)];
        }
        
        return $hash;
    }
}
