<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MailController
 *
 * @author ishibkikh
 */
class MailController extends \System\Controller {
    
    public function get(){}
    
    public function allowAccess() {
        return \Auth\User::ROLE_MEMBER;
    }
}
