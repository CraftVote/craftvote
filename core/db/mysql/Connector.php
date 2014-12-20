<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DB\MySQL;

/**
 * Description of MySQL
 *
 * @author ishibkikh
 */
class Connector {
    
    protected static $_instance;
    
    private static function connect(){
 
        //mysqli_report(MYSQLI_REPORT_ALL);
        mysqli_report(MYSQLI_REPORT_ERROR);
        $config = \System\ApplicationRegistry::getConfig();
        $dbh = new \mysqli($config->db_host, $config->db_user, $config->db_password, $config->db_database);
        if (!$dbh){
            throw new \System\Exception('Unable connect to DB ('.$config->db_database.')');
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
