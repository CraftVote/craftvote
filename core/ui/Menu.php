<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI;

/**
 * Description of Menu
 *
 * @author Ivan
 */
class Menu {
    
    protected $brand, $active, $left = array(), $right = array();

    public function __construct($brand) {
        $this->brand = $brand;
    }
    
    public function activeButton($action){
        $this->active = $action;
    }

    public function addLeftButton($title, $action = '#', $onclick = null){
        if ($this->active === $action){
            $this->left[] = '<li class="active"><a href="'.$action.'" onclick="'.$onclick.'">'.$title.'</a></li>';
        }
        else{
            $this->left[] = '<li><a href="'.$action.'" onclick="'.$onclick.'">'.$title.'</a></li>';
        }
    }
    
    public function addRightText($text){
        $this->right[] = '<p class="navbar-text">'.$text.'</p>';
    }

    public function addRightButton($title, $action = '#', $onclick = null){
        if ($this->active === $action){
            $this->right[] = '<li class="active"><a href="'.$action.'" onclick="'.$onclick.'">'.$title.'</a></li>';
        }
        else{
            $this->right[] = '<li><a href="'.$action.'" onclick="'.$onclick.'">'.$title.'</a></li>';
        }
    }
    
    public function addRightDropdown($label, $items){
        
        $html = '';
        foreach ($items as $title => $link){
            if ($title === 'divider')
            {
                $html .= '<li class="divider"></li>';
            }
            else{
                $html .= '<li><a href="'.$link.'">'.$title.'</a></li>';
            }
        }
        $this->right[] = '<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'.$label.' <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">'.$html.'</ul>
                          </li>';
    }

    public function getHtml(){
        return '<nav class="navbar navbar-default" role="navigation">
                    <div class="container-fluid">
                      <!-- Brand and toggle get grouped for better mobile display -->
                      <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="/">'.$this->brand.'</a>
                      </div>

                      <!-- Collect the nav links, forms, and other content for toggling -->
                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                          '.implode('', $this->left).'
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                          '.implode('', $this->right).'
                        </ul>
                      </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                  </nav>';
    }
}
