<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Custom;

/**
 * Description of Project
 *
 * @author ishibkikh
 */
class Project {
    
    static public function getByUserId($id){
        
        $sql = 'SELECT * FROM projects WHERE user_id = '.intval($id).' ORDER BY id DESC';
        return \DB\MySQL\Executor::fetchAll($sql);
    }
}
