<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Custom;

/**
 * Description of Finance
 *
 * @author ishibkikh
 */
class Finance {
    
    const 
        MAX_AMOUNT  = 10000,
        MAX_BALANCE = 100000;
    
    static public $error;
    

    static public function getBalance($user_id){
        
        $user = new \Models\Tables\Users();
        $mapper = new \DB\MySQL\DataMapper($user);
        if (!$mapper->findById($user_id)){
            throw new \System\Exception(__CLASS__.':'.__METHOD__." - Cannot find user with id=".$user_id);
        }
        return $user->balance;
    }
    
    static public function deduct($user_id, $iamount, $comment){
        
        $amount = round($iamount, 2);
        self::$error = '';
        
        if ($amount < 0){
            self::$error = 'Сервис не принимает отрицательные суммы';
            return false;
        }
        if ($amount > self::MAX_AMOUNT){
            self::$error = 'Максимальная сумма транзакции не может превышать '.self::MAX_AMOUNT;
            return false;
        }
        $user = new \Models\Tables\Users();
        $mapper = new \DB\MySQL\DataMapper($user);
        if (!$mapper->findById($user_id)){
            throw new \System\Exception(__CLASS__.':'.__METHOD__." - Cannot find user with id=".$user_id);
        }
        if (($user->balance - $amount)< 0){
            self::$error = 'Недостаточно средств на счёте';
            return false;
        }
     
        $user->balance = $user->balance - $amount;
        $mapper->save();
        \System\Logger::finance('DEDUCT from user '.$user_id.' amount '.$amount.' balance '.$user->balance.' '.$comment);
        
        $mail = new \Custom\FromSystemEmail($user->email, 'Списание средств с вашего счёта');
        $mail->template('deduct_money');
        $mail->set('name', $user->name);
        $mail->set('amount', $amount);
        $mail->set('balance', $user->balance);
        $mail->set('comment', $comment);
        $mail->go();
        
        return true;
    }
    
    
    static public function fill($user_id, $iamount, $comment){
        
        $amount = round($iamount, 2);
        self::$error = '';
        if ($amount < 0){
            self::$error = 'Сервис не принимает отрицательные суммы';
            return false;
        }
        if ($amount > self::MAX_AMOUNT){
            self::$error = 'Максимальная сумма транзакции не может превышать '.self::MAX_AMOUNT;
            return false;
        }
        $user = new \Models\Tables\Users();
        $mapper = new \DB\MySQL\DataMapper($user);
        if (!$mapper->findById($user_id)){
            throw new \System\Exception(__CLASS__.':'.__METHOD__." - Cannot find user with id=".$user_id);
        }
        if (($user->balance + $amount) > self::MAX_BALANCE){
            self::$error = 'Превышена максимально возможная сумма для одного счёта';
            return false;
        }
        
        $user->balance = $user->balance + $amount;
        $mapper->save();
        \System\Logger::finance('FILL to user '.$user_id.' amount '.$amount.' balance '.$user->balance.' '.$comment);
        
        $mail = new \Custom\FromSystemEmail($user->email, 'Пополнение средств на вашем счёте');
        $mail->template('fill_money');
        $mail->set('name', $user->name);
        $mail->set('amount', $amount);
        $mail->set('balance', $user->balance);
        $mail->set('comment', $comment);
        $mail->go();
        
        return true;
    }
    
}
