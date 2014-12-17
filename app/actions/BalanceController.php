<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BalanceController
 *
 * @author ishibkikh
 */
class BalanceController extends \System\Controller {
    
    public function get(){
        
        $user = new \Models\Tables\Users();
        $mapper = new \DB\MySQL\DataMapper($user);
        if (!$mapper->findById(\Auth\User::getId())){
            throw new \System\Exception('User not found');
        }
        $this->setParam('balance', $user->balance);
        $this->setParam('bonus', $user->bonus);
        
        $sql = 'SELECT * FROM payments where user_id = '.$user->getId().' ORDER BY id DESC LIMIT 10;';
        $this->setParam('operations', \DB\MySQL\Executor::fetchAll($sql));
    }
    
    public function allowAccess() {
        return \Auth\User::ROLE_MEMBER;
    }
}
