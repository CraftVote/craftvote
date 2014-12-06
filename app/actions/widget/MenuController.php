<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuController
 *
 * @author Ivan
 */
class MenuController extends \System\Controller {
    
    public function get() {
        if (\Auth\User::isAuth()){
            $this->moveTo('widget menu auth');
        }
        else{
            $this->moveTo('widget menu notauth');
        }
    }
    
    public function allowAccess() {
        return NULL;
    }
}
