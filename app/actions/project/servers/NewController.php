<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NewController
 *
 * @author ishibkikh
 */
class NewController extends \System\Controller {
    
    public function post($id){
        
        $ajax = new \System\Ajax();
        $form = new \Models\Forms\CreateServer(intval($id));
        $ajax->ajax_success($form->getArray());
        $this->setAjax($ajax);
    }
    
    public function allowAccess() {
        return \Auth\User::ROLE_MEMBER;
    }
}
