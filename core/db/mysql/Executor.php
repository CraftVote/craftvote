<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DB\MySQL;

/**
 * Description of Executor
 *
 * @author ishibkikh
 */
class Executor {
    
    private function __construct() {}
    
    static private function exeucute(\mysqli $mysql, $sql){
        try
        {
            $result = $mysql->query($sql);
        }
        catch (mysqli_sql_exception $e)
        {
            throw new \System\Exception($e->getMessage());
        }
        return $result;
    }
    
    static public function fetchOne($sql){
        
        $collection = self::exeucute(\DB\MySQL\Connector::getInstance(), $sql);
        if ($collection->num_rows === 0){
            $result = false;
        }
        else{
            $result = $collection->fetch_array();
        }
        $collection->close();
    }
    
    static public function fetchAll($sql){
        $collection = self::exeucute(\DB\MySQL\Connector::getInstance(), $sql);
        if ($collection->num_rows === 0){
            $result = false;
        }
        else{
            $result = $collection->fetch_all();
        }
        $collection->close();
    }
}
