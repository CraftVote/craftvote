<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Models\Tables;

/**
 * Description of Projects
 *
 * @author ishibkikh
 */
class Projects extends \DB\MySQL\AbstractModel {
    
    public $id;
    public $title;
    public $description;
    public $website;
    public $active;
    public $date_reg;
    public $sn;
    public $banner;
    public $user_id;
    
    public function getPrimaryKey() {
        return 'id';
    }
}
