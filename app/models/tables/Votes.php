<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Models\Tables;

/**
 * Description of Votes
 *
 * @author ishibkikh
 */
class Votes extends \DB\MySQL\AbstractModel {
    
    public $id;
    public $vk_id;
    public $ip;
    public $date;
    public $project_id;
        
    public function getPrimaryKey() {
        return 'id';
    }
}
