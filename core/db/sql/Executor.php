<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DB\SQL;

/**
 * Description of Executor
 *
 * @author ishibkikh
 */
class Executor {
    
    private function __construct() {}
    
    static public function exeucute(\PDO $pdo, $sql, $params = null){
        try{
           \System\Logger::sql($sql);
            $statement = $pdo->prepare($sql);
            if (is_array($params)){
                foreach($params as $element){
                    $statement->bindValue($element['mask'], $element['value'], $element['type']);
                   \System\Logger::sql($element['mask']. ' = ' . $element['value']);
                }
            }
            if (!$statement->execute()){
                $result = $statement->errorInfo();
                throw new \System\Exception($result[2]);
            }
        }
        catch (PDOException  $e){
            throw new \System\Exception($e->getMessage());
        }    
        return $statement;
    }
}
