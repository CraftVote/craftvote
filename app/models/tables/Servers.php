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
class Servers extends \DB\MySQL\AbstractModel {
    
    public $id;
    public $title;
    public $version;
    public $client;
    public $wlist;
    public $pvp;
    public $host;
    public $players;
    public $active;
    public $project_id;
    
    public function getPrimaryKey() {
        return 'id';
    }
}
