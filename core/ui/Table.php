<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace UI;
/**
 * Description of Table
 *
 * @author ishibkikh
 */
class Table {
    
    protected $class = array(), $rows = array(), $titles = array();
    
    public function __toString() {
        
        return $this->getHtml();
    }
    
    public function getHtml() {
        $html = '<table class="'.  implode(' ', $this->class).'">';
        if (count($this->titles)>0){
            $html .= '<tr>';
            foreach ($this->titles as $th){
                $html .= '<th>'.$th.'</th>';
            }
            $html .= '</tr>';
            foreach ($this->rows as $row){
                $html .= '<tr>';
                foreach ($row as $cell){
                    $html .= '<td>'.$cell.'</td>';
                }
                $html .= '</tr>';
            }
        }
        $html .= '</table>';
        return $html;
    }
    
    public function addRow(array $params){
        $this->rows[] = $params;
    }
    
    public function titles(array $titles){
        $this->titles = $titles;
    }
    
    public function __construct() {
        $this->class[] = 'table';
    }

    public function striped(){
        $this->class[] = 'table-striped';
    }
    
    public function bordered(){
        $this->class[] = 'table-bordered';
    }
    
    public function hover(){
        $this->class[] = 'table-hover';
    }
    
    public function condensed(){
        $this->class[] = 'table-condensed';
    }
}
