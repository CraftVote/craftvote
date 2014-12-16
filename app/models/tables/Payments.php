<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Models\Tables;

/**
 * Description of Payments
 *
 * @author ishibkikh
 */
class Payments extends \DB\MySQL\AbstractModel {
    
    public $id;
    public $amount;
    public $from;
    public $to;
    public $comment;
    public $status;
    public $date_reg;
    
    public function getPrimaryKey() {
        return 'id';
    }
}
