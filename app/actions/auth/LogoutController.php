<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LogoutController
 *
 * @author Ivan
 */
class LogoutController extends \System\Controller {
    
    public function get(){
        \Auth\Identity::logout();
        $this->redirect('/');
    }
    
    public function allowAccess() {
        return false;
    }
}
