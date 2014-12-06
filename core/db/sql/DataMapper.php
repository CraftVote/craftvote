<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DB\SQL;

/**
 * Description of DataMapper
 *
 * @author Ivan
 */
class DataMapper
{
    private $table;
    private $request;
    private $entity;

    public function __construct($entity) {
        if (!is_subclass_of($entity, '\DB\SQL\AbstractModel')){
            throw new \System\Exception('DataMapper can accept only subclasses of DB\\SQL\\AbstractModel ('.get_parent_class($entity).')');
        }
        $reflect = new \ReflectionClass($entity);
        $props   = $reflect->getProperties();
        $raw = explode('\\', $props[0]->class);
        $this->table = strtolower($raw[count($raw)-1]);
        $this->request = new \DB\SQL\RequestBuilder(\DB\SQL\MySqlConnector::getInstance());
        $this->entity = $entity;
    }
    
    public function getTableName(){
        return $this->table;
    }

    public function findById($id){
        $result = $this->request->from($this->table)->where(array($this->entity->getPrimaryKey() => $id))->fetchOne();
        if (!$result){
            return false;
        }
        else{
            $this->entity->assignFromArray($result);
            return true;
        }
    }
    
    public function find(){
        $this->request->from($this->table)->where($this->entity);
        return $this->request->fetchAll();
    }
    
    public function findOne(){
        $result = $this->request->from($this->table)->where($this->entity)->fetchOne();
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
            $this->request->insertInto($this->table)->values($this->entity)->exec();
            $id = $this->request->getInsertId();
            $this->entity->setId($id);
            return $id;
        }
        else{
            return $this->request->update($this->table)->values($this->entity)->where(array($this->entity->getPrimaryKey() => $this->entity->getId()))->exec();
        }
    }
    
    public function findAll(){
        return $this->request->from($this->table)->fetchAll();
    }
    
    public function getRowsCount(){
        $reuslt = $this->request->selectCount('count')->from($this->table)->fetchOne();
        return $reuslt['count'];
    }
}
