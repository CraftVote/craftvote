<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Custom;

/**
 * Description of SystemEmail
 *
 * @author ishibkikh
 */
class FromSystemEmail extends \System\Email {
    
    protected $bodyText;

    public function __construct($toEmail, $subject) {
        parent::__construct();
        $this->From(\System\Config::get('system_sender_email'));
        $this->To($toEmail);
        $this->Subject($subject);
        $this->Priority(3);
    }
    
    public function go(){
        if ($this->bodyText !== NULL){
            $this->Body($this->bodyText);
        }
        $this->Send();
    }
    
    public function set($param, $value){
        $this->bodyText = str_replace('%'.$param.'%', $value, $this->bodyText);
    }

    public function template($name){
        $file = PATH . DIRECTORY_SEPARATOR. 'app' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'texts' . DIRECTORY_SEPARATOR . $name .'.tpl';
        if (!file_exists($file)){
            throw new \System\Exception('Email template "'.$file.'" not found');
        }
        $this->bodyText = file_get_contents($file);
    }
}
