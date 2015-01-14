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
    
    static public function increaseVotes($project_id){
        
        $project = new \Models\Tables\Projects();
        $mapper = new \DB\MySQL\DataMapper($project);
        if ($mapper->findById($project_id)){
            $project->clear();
            $project->votes = intval($project->votes) + 1;
            $mapper->save();
        }
    }

    static public function getByUserId($id){
        $sql = 'SELECT * FROM projects WHERE user_id = '.intval($id).' ORDER BY id DESC';
        return \DB\MySQL\Executor::fetchAll($sql);
    }
    
    static public function getByProjectId($id){
        $sql = 'SELECT p.id, p.title, p.description, p.active, p.date_reg, p.website, p.sn, p.logo, u.name, u.id as user_id FROM projects p LEFT JOIN users u ON p.user_id = u.id  WHERE p.id = '.$id.' LIMIT 1;';
        return \DB\MySQL\Executor::fetchOne($sql);
    }
    
    static public function getActive(){
        $sql = 'SELECT * FROM projects WHERE active = 1 ORDER BY rating DESC;';
        return \DB\MySQL\Executor::fetchAll($sql);
    }
}
