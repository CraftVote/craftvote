<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace System;
/**
 * Description of URL
 *
 * @author ishibkikh
 */
class URL {
    
    static public function format($url){
        
        if (parse_url($url, PHP_URL_SCHEME) == NULL){
            
            return 'http://'.parse_url($url, PHP_URL_HOST).parse_url($url, PHP_URL_PATH);
        }
        else {
            return $url;
        }
    }
}
