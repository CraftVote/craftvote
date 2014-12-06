<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DB\SQL;

/**
 * Description of MySQL
 *
 * @author ishibkikh
 */
class MySqlConnector {
    
    protected static $_instance;
    
    public static function getInstance() {
        if (self::$_instance === null)
        {
            try
            {
                $config = \System\ApplicationRegistry::getConfig();
                self::$_instance = new \PDO('mysql:host='.$config->db_host.';charset=utf8;dbname='.$config->db_database, $config->db_user, $config->db_password);
            }
            catch (PDOException  $e)
            {
                throw new \System\Exception($e->getMessage());
            }
        }
        return self::$_instance;
    }
    
    private function __clone() {}

    private function __wakeup() {}   
    
    private function __construct() {}
}
