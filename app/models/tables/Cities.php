<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Models\Tables;

/**
 * Description of Cities
 *
 * @author Ivan
 */
class Cities extends \DB\MySQL\AbstractModel {
    
    public $id;
    public $title;
    public $utc;
    
    public function getPrimaryKey() {
        return 'id';
    }
}
