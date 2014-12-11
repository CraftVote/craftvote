<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MynewsController
 *
 * @author ishibkikh
 */
class MynewsController extends \System\Controller {
    
    public function get(){}
    
    public function allowAccess() {
        return \Auth\User::ROLE_MEMBER;
    }
}
