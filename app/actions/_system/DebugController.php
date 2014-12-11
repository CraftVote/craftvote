<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DebugController
 *
 * @author ishibkikh
 */
class DebugController extends \System\Controller{
    
    public function get(){
        
        $config = \System\ApplicationRegistry::getConfig();
        $dbh = new \mysqli($config->db_host, $config->db_user, $config->db_password, $config->db_database);
        $sql = 'SELECT * FROM users WHERE id = 2 LIMIT 1;';
        $collection = $dbh->query($sql);
        $result = $collection->fetch_array();
        echo $result['name'];
        $collection->close();
        $dbh->close();
        
        $this->close();
    }
    
    public function allowAccess() {
        return NULL;
    }
}
