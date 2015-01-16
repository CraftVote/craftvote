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
class UserToSystemEmail extends \System\Email {
    
    public function __construct($fromEmail, $subject, $username, $body) {
        parent::__construct();
        $this->From($fromEmail);
        $this->To(\System\Config::get('admin_email'));
        $this->Subject($subject);
        $this->Body($body.PHP_EOL.PHP_EOL.$username);
        $this->Priority(3);
    }
    
    public function go(){
        $this->Send();
    }
}
