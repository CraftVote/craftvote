<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProfileController
 *
 * @author ishibkikh
 */
class ProfileController extends \System\Controller {
    
    public function get($id){
        
        $user = new \Models\Tables\Users();
        $mapper = new \DB\SQL\DataMapper($user);
        if (!$mapper->findById(intval($id))){
            $this->pageNotFound();
        }
        else{
            $this->setParam('user', $user);
            if (\Auth\User::getId() == $id){
                $this->setParam('mine', true);
            }
            else{
                $this->setParam('mine', false);
            }
        }
    }
    
    public function allowAccess() {
        return \Auth\User::ROLE_MEMBER;
    }
            
}
