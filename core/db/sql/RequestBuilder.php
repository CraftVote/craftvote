<?php

/*
 * version 1.0.0
 */

namespace DB\SQL;

/**
 * Description of Request
 *
 * @author ishibkikh
 */
class RequestBuilder {
    
    private $pdo, $table, $sel, $where, $limit, $offset, $order, $reqtype, $sql, $values, $statement, $join, $replaced_items;
    
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->sel = '*';
    }
    
    private function clear()
    {
        $this->table = NULL;
        $this->sel = '*';
        $this->where = array();
        $this->values = array();
        $this->limit = NULL;
        $this->offset = NULL;
        $this->order = NULL;
        $this->reqtype = NULL;
        $this->sql = NULL;
        $this->statement = NULL;
        $this->join = NULL;
    }

    public function from($table)
    {
        $this->table = $table;
        $this->reqtype = 'SELECT';
        return $this;
    }
    
    
    public function insertInto($table)
    {
        $this->reqtype = 'INSERT';
        $this->table = $table;
        return $this;
    }
    
    public function deleteFrom($table)
    {
        $this->reqtype = 'DELETE';
        $this->table = $table;
        return $this;
    }
    
    public function update($table)
    {
        $this->reqtype = 'UPDATE';
        $this->table = $table;
        return $this;
    }
    
    public function select($fields)
    {
        if (is_array($fields))
        {
            $this->sel = implode(', ', $fields);
        }
        else
        {
            $this->sel = $fields;
        }
        return $this;
    }
    
    public function getInsertId(){
        return $this->pdo->lastInsertId();
    }

    public function selectCount($nickname)
    {
        $this->sel = ' COUNT(*) AS '.$nickname;

        return $this;
    }
    
    public function where($fields)
    {
        if (is_string($fields)){
            $this->where[] = $fields;
            return $this;
        }
        
        $statement = array();
        $i = 0;
        foreach ($fields as $key => $value){
            if ($value === null){
                continue;
            }
            $i++;
            $statement[] = $key.' = :'.$i;
            if (is_string($value)){
                $this->replaced_items[] = array('mask' => ':'.$i, 'value' => $value, 'type' => \PDO::PARAM_STR);
            }
            else{
                $this->replaced_items[] = array('mask' => ':'.$i, 'value' => $value, 'type' => \PDO::PARAM_INT);
            }
        }
        if (count($statement) === 0){
            throw new \System\Exception('Danger SQL request, WHERE section has empty condition');
        }
        $this->where[] = implode(' AND ', $statement);
        return $this;
    }
    
    public function leftJoin($table, $condition)
    {
        $this->join[] = ' LEFT JOIN '.$table.' ON '.$condition;
        return $this;
    }
    
    public function rightJoin($table, $condition)
    {
        $this->join[] = ' RIGHT JOIN '.$table.' ON '.$condition;
        return $this;
    }
    
    public function limit($int)
    {
        if (intval($int) > 0)
        {
            $this->limit = intval($int);
        }
        return $this;
    }
       
    public function values($params)
    {
        $statement = array();

        if ($this->reqtype === 'INSERT'){
            foreach ($params as $key => $val){  
                if (($val === NULL)or($key === $params->getPrimaryKey())){
                    continue;
                }
                if (is_string($val)){
                    $this->replaced_items[] = array('mask' => $key, 'value' => $val, 'type' => \PDO::PARAM_STR);
                }
                else{
                    $this->replaced_items[] = array('mask' => $key, 'value' => $val, 'type' => \PDO::PARAM_INT);
                }
                $statement[$key] = ':'.$key;
            }
            $fields = array_keys($statement);
            $values = array_values($statement);
            $this->values = ' ('.implode(', ', $fields).') VALUES ('.implode(', ', $values).')';
        }
        
        if ($this->reqtype === 'UPDATE'){
            foreach ($params as $key => $val){  
                if ($val === NULL){
                    continue;
                }
                if (is_string($val)){
                    $this->replaced_items[] = array('mask' => $key, 'value' => $val, 'type' => \PDO::PARAM_STR);
                }
                else{
                    $this->replaced_items[] = array('mask' => $key, 'value' => $val, 'type' => \PDO::PARAM_INT);
                }
                $statement[] = $key.' = :'.$key;
           }
            $this->values = ' SET '.implode(', ', $statement);
        }
        return $this;
    }
    
    
    public function offset($int)
    {
        if (intval($int) > 0)
        {
            $this->offset = intval($int);
        }
        return $this;
    }
    
    
    public function orderBy($field, $Descending = false)
    {
        if ($Descending === false)
        {
            $this->order = $field;
        }
        else
        {
            $this->order = $field.' DESC';
        }

        return $this;
    }
    
    
    private function generateSelectQuery()
    {
        if ($this->reqtype !== 'SELECT'){
            throw new \System\Exception('Incorrect SQL-request type');
        }
        
        $this->sql = 'SELECT '.$this->sel.' FROM '.$this->table;
        
        if (!is_null($this->join)){
            if (count($this->join)===1){
                $this->sql .= $this->join[0];
            }
            else{
                $this->sql .= implode(' ', $this->join);
            }
        }
        
        if (count($this->where)>0){
            if (count($this->where) === 1){
                $this->sql .= ' WHERE '.$this->where[0];
            }
            else{
                $this->sql .= ' WHERE '.implode(' AND ', $this->where);
            }
        }
        
        if (!is_null($this->order)){
            $this->sql .= ' ORDER BY '.$this->order;
        }
        
        if (!is_null($this->limit)){
            $this->sql .= ' LIMIT '.$this->limit;
        }
        
        if (!is_null($this->offset)){
            $this->sql .= ' OFFSET '.$this->offset;
        }
    }
    
    
    private function generateInsertQuery()
    {
        if ($this->reqtype !== 'INSERT')
        {
            throw new \System\Exception('Incorrect SQL-request type');
        }
        
        $this->sql = 'INSERT INTO '.$this->table.$this->values;
    }
    
    
    private function generateDeleteQuery()
    {
        if ($this->reqtype !== 'DELETE')
        {
            throw new \System\Exception('Incorrect SQL-request type');
        }
        
        $this->sql = 'DELETE FROM '.$this->table;
        
        if (count($this->where)>0)
        {
            $this->sql .= ' WHERE '.$this->where[0];
        }
    }
    
    private function generateUpdateQuery()
    {
        if ($this->reqtype !== 'UPDATE')
        {
            throw new \System\Exception('Incorrect SQL-request type');
        }
        
        $this->sql = 'UPDATE '.$this->table.$this->values;
        
        if (count($this->where)>0)
        {
            $this->sql .= ' WHERE '.$this->where[0];
        }
    }
    
    public function sysExecQuery($sql, $params)
    {
        $statement = \DB\SQL\Executor::exeucute($this->pdo, $sql, $params);
        $this->clear();
        if ($statement->rowCount() === 0){
            return false;
        }
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    private function sysExecProc($sql, $params)
    {
        $statement = \DB\SQL\Executor::exeucute($this->pdo, $sql, $params);
        $this->clear();
        return $statement->rowCount();
    }
    
    
    public function performFromFile($filename, $params){
        $sql = file_get_contents(PATH . DIRECTORY_SEPARATOR. 'application'. DIRECTORY_SEPARATOR.'sql' . DIRECTORY_SEPARATOR.$filename.'.sql');
        return $this->sysExecQuery($sql, $params);
    }
    

    public function fetchAll()
    {
        $this->generateSelectQuery();        
        $items = $this->replaced_items;
        $this->replaced_items = array();
        return $this->sysExecQuery($this->sql, $items);
    }
    
    
    public function fetchOne()
    {
        $this->limit = 1;
        $this->generateSelectQuery();
        $result = $this->sysExecQuery($this->sql, $this->replaced_items);
        $this->replaced_items = array();
        return $result[0];
    }
    
    
    public function exec()
    {
        if ($this->reqtype === 'INSERT')
        {
            $this->generateInsertQuery();
        }
        
        if ($this->reqtype === 'DELETE')
        {
            $this->generateDeleteQuery();
        }
        
        if ($this->reqtype === 'UPDATE')
        {
            $this->generateUpdateQuery();
        }
        
        $result = $this->sysExecProc($this->sql, $this->replaced_items);
        $this->replaced_items = array();
        
        return $result;
    }
    
}
