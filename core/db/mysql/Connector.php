<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DB\MySQL;

use \System\Config;
/**
 * Description of MySQL
 *
 * @author ishibkikh
 */
class Connector {
    
    
    
    protected static $_instance;
    
    private static function connect(){
 
        if (Config::get('debug') == true){
            mysqli_report(MYSQLI_REPORT_ALL);
        }
        else{
            mysqli_report(MYSQLI_REPORT_ERROR);
        }
        $dbh = new \mysqli(Config::get('db_host'), Config::get('db_user'), Config::get('db_password'), Config::get('db_name'));
        if (!$dbh){
            throw new \System\Exception('Unable connect to DB ('.Config::get('db_name').')');
        }
        $dbh->set_charset("utf8");
        return $dbh;
    }
    
    public static function getInstance() {
        if (self::$_instance === null)
        {
            self::$_instance = self::connect();
        }
        return self::$_instance;
    }
    
    public static function disconnect(){
        if (self::$_instance !== null)
        {
            self::$_instance->close();
        }
    }


    private function __clone() {}

    private function __wakeup() {}   
    
    private function __construct() {}
}
