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
class Users extends \DB\MySQL\AbstractModel {
    
    public $id;
    public $name;
    public $password;
    public $email;
    public $role;
    public $date_create;
    public $active;
    public $session;
    public $verified;
    public $city;
    public $balance;
    
    public function getPrimaryKey() {
        return 'id';
    }
}
