<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Models\Tables;
/**
 * Description of Users
 *
 * @author Ivan
 */
class Payments extends \DB\MySQL\AbstractModel {
    
    public $id;
    public $date_reg;
    public $user_id;
    public $type;
    public $amount;
    public $comment;
    public $direction;
    
    public function getPrimaryKey() {
        return 'id';
    }
}
