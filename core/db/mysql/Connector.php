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
 
        mysqli_report(MYSQLI_REPORT_ALL);
        $config = \System\ApplicationRegistry::getConfig();
        self::$_instance = new \mysqli($config->db_host, $config->db_user, $config->db_password, $config->db_database);
        if (mysqli_connect_errno()){
            throw new \System\Exception('Unable connect to DB ('.$config->db_database.')');
        }
        self::$_instance->set_charset("utf8");
    }
    
    public static function getInstance() {
        if (self::$_instance === null)
        {
            self::$_instance = self::connect();
        }
        return self::$_instance;
    }
    
    public static function disconect(){
        if (self::$_instance !== null)
        {
            self::$_instance->close();
        }
    }


    private function __clone() {}

    private function __wakeup() {}   
    
    private function __construct() {}
}
