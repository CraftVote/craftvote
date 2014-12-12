<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DB\MySQL;

/**
 * Description of DataMapper
 *
 * @author Ivan
 */
class DataMapper
{
    private $table;
    private $entity;

    public function __construct($entity) {
        if (!is_subclass_of($entity, '\DB\MySQL\AbstractModel')){
            throw new \System\Exception('DataMapper can accept only subclasses of DB\\MySQL\\AbstractModel ('.get_parent_class($entity).')');
        }
        $reflect = new \ReflectionClass($entity);
        $props   = $reflect->getProperties();
        $raw = explode('\\', $props[0]->class);
        $this->table = strtolower($raw[count($raw)-1]);
        $this->entity = $entity;
    }
    
    public function getTableName(){
        return $this->table;
    }

    public function findById($id){
        $sql = 'SELECT * FROM '.$this->table.' WHERE '.$this->entity->getPrimaryKey().' = '.$id. ' LIMIT 1;';
        $result = \DB\MySQL\Executor::fetchOne($sql);
        if (!$result){
            return false;
        }
        else{
            $this->entity->assignFromArray($result);
            return true;
        }
    }
    
    public function findAll(){
        $sql = 'SELECT * FROM '.$this->table.' WHERE '. \DB\MySQL\Builder::condition($this->entity).' ORDER BY '.$this->entity->getPrimaryKey().';';
        return \DB\MySQL\Executor::fetchAll($sql);
    }
    
    public function findOne(){
        $sql = 'SELECT * FROM '.$this->table.' WHERE '. \DB\MySQL\Builder::condition($this->entity).' LIMIT 1;';
        $result = \DB\MySQL\Executor::fetchOne($sql);
        if (!$result){
            return false;
        }
        else{
            $this->entity->assignFromArray($result);
            return true;
        }
    }
    
    public function delete(){
        $this->request->deleteFrom($this->table);
        if ($this->entity->getId() <> null){
            $this->request->where(array($this->entity->getPrimaryKey() => $this->entity->getId()));
        }
        else{
            $this->request->where($this->entity);
        }
        return $this->request->exec();
    }
    
    public function save(){
        if ($this->entity->getId() == null){
            $sql = 'INSERT INTO '.$this->table.' ('. \DB\MySQL\Builder::fields($this->entity).') VALUES ('. \DB\MySQL\Builder::values($this->entity).');';
            $id = \DB\MySQL\Executor::insert($sql);
            if ($id){
                $this->entity->setId($id);
                return $id;
            }
            else{
                return false;
            }
            
        }
        else{
            $sql = 'UPDATE '.$this->table.' SET '.\DB\MySQL\Builder::items($this->entity).' WHERE '.$this->entity->getPrimaryKey().' = '.$this->entity->getId().';';
            return \DB\MySQL\Executor::modify($sql);
        }
    }
}