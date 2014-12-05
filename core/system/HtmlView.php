<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace System;

/**
 * Description of HtmlView
 *
 * @author Ivan
 */
abstract class HtmlView extends View {
    
    public function h1($value){
        $this->body('<h1>'.$value.'</h1>');
    }
    
    public function h2($value){
        $this->body('<h2>'.$value.'</h2>');
    }
    
    public function h3($value){
        $this->body('<h3>'.$value.'</h3>');
    }
    
    public function h4($value){
        $this->body('<h4>'.$value.'</h4>');
    }
    
    public function p($value){
        $this->body('<p>'.$value.'</p>');
    }
    
    public function p_muted($value){
        $this->body('<p class="text-muted">'.$value.'</p>');
    }
    
    public function hr($class = null){
        if ($class === null){
            $this->body('<hr>');
        }
        else{
            $this->body('<hr class="'.$class.'">');
        }
    }
    
    public function br(){
        $this->body('<br>');
    }
    
    public function default_text($text){
        $this->body('<div class="col-sm-12"><p class="text-muted">'.$text.'</p></div>');
    }
    
    public function pageHeader($text){
        $this->body('<div class="page-header"><h1>'.$text.'</h1></div>');
    }
        
    public function getSelectOptions($items, $key, $value){
        $html = '';
        foreach ($items as $item){
            $html .= '<option value="'.$item[$key].'">'.$item[$value].'</option>';
        }
        return $html;
    }
}
