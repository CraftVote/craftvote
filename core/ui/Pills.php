<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI;

/**
 * Description of Pills
 *
 * @author Ivan
 */
class Pills {
    
    protected $items = array();

    public function append($title, $url){
        
        $this->items[] = array($title, $url);
    }
    
    public function toHtml() {
        
        $in_url = filter_input(INPUT_SERVER, 'REQUEST_URI');
        $html = '<ul class="nav nav-pills">';
        foreach ($this->items as $item){
            if ($in_url === $item[1]){
                $html .= '<li role="presentation" class="active"><a href="#">'.$item[0].'</a></li>';
            }
            else{
                $html .= '<li role="presentation"><a href="'.$item[1].'">'.$item[0].'</a></li>';
            }
        }
        $html .= '</ul>';
        return $html;
    }
}
