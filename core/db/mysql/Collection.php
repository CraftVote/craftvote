<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DB\MySQL;

/**
 * Description of ResultCollection
 *
 * @author ishibkikh
 */
class Collection implements \Iterator, \Countable {
    
    protected $collection;
    private $position = 0;
    
    public function __construct($collection) {
        
        $this->collection = $collection;
        $this->position = 0;
    }
    
    function rewind() {
        $this->position = 0;
    }
    
    function current() {
        return $this->collection->fetch_object();
    }
    
    function key() {
        return $this->position;
    }
    
    function next() {
        ++$this->position;
    }
    
    function valid() {
        return $this->position < $this->collection->num_rows;
    }
    
    public function count() {
        return $this->collection->num_rows;
    }
}
