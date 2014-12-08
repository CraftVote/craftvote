<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CaptchaCommand
 *
 * @author ishibkikh
 */
class CaptchaController extends \System\Controller {
    
    public function get() {
        
        $captcha = new \Captcha\KCaptcha();
        \System\Session::startNew();
        \System\Session::set('captcha', $captcha->getKeyString());
        $this->close();
    }
    
    public function allowAccess() {
        return null;
    }
    
}
