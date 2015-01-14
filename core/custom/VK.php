<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Custom;
/**
 * Description of VK
 *
 * @author ishibkikh
 */
class VK {
    
    const APP_SHARED_SECRET = 'm5ZSWD2Gd9f0xTFnqoc7';
    const APP_ID = '4729747';
    
    static public function authOpenAPIMember() { 
        $session = array(); 
        $member = FALSE; 
        $valid_keys = array('expire', 'mid', 'secret', 'sid', 'sig'); 
        $app_cookie = $_COOKIE['vk_app_'.  self::APP_ID]; 
        if ($app_cookie){ 
            $session_data = explode ('&', $app_cookie, 10); 
            foreach($session_data as $pair){ 
                list($key, $value) = explode('=', $pair, 2); 
                if (empty($key) || empty($value) || !in_array($key, $valid_keys)){ 
                    continue; 
                } 
                $session[$key] = $value; 
            } 
            foreach ($valid_keys as $key){ 
                if (!isset($session[$key])){
                    return $member; 
                }
            } 
            ksort($session); 
            $sign = ''; 
            foreach ($session as $key => $value){ 
                if ($key != 'sig'){ 
                    $sign .= ($key.'='.$value); 
                } 
            } 
            $sign .= self::APP_SHARED_SECRET; 
            $sign_md5 = md5($sign); 
            if ($session['sig'] == $sign_md5 && $session['expire'] > time()){ 
                $member = array( 
                    'id' => intval($session['mid']), 
                    'secret' => $session['secret'], 
                    'sid' => $session['sid'] 
                );
            } 
        } 
        return $member; 
    } 
    
}
