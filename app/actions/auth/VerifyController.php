<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VerifyController
 *
 * @author Ivan
 */
class VerifyController extends \System\Controller {
    
    public function get($hash){
        
        $verify = new \Models\Tables\Verify();
        $verify->hash = $hash;
        $mv = new \DB\MySQL\DataMapper($verify);
        if (!$mv->findOne()){
            $this->pageNotFound();
        }
        else{
            $user = new \Models\Tables\Users();
            $mapper = new \DB\MySQL\DataMapper($user);
            $user->setId($verify->user_id);
            $user->verified = 1;
            $mapper->save();
            $mv->delete();
            
            \Custom\Finance::fill($user->getId(), '50', 'бонус за подтверждение E-mail');
            $this->redirect('/auth/verify/success');
        }
    }
    
    public function allowAccess() {
        return NULL;
    }
}
