<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace UI;

/**
 * Description of Carousel
 *
 * @author Ivan
 */
class Carousel {
    
    protected $items = array();
    
    public function append($title, $comment, $img, $src, $inverseColor = false){
        
        $this->items[] = array($title, $comment, $img, $src, $inverseColor);
    }
    
    public function toHtml(){
        
        $html = '<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">';
        $i = 0;
        $indicators = '<ol class="carousel-indicators">';
        $slides = '<div class="carousel-inner" role="listbox">';
        foreach ($this->items as $item){
            if ($i === 0){
                $indicators .= '<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>';
                $slides .= '<div class="item active">
                                <img src="'.$item[2].'">
                                <div class="carousel-caption">
                                  <h1>'.$item[0].'</h1>
                                  <p>'.$item[1].'</p>
                                  <p><a href="'.$item[3].'"><button class="btn btn-info">Подробнее</button></a></p>
                                </div>
                            </div>';
            }
            else{
                $indicators .= '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'"></li>';
                if ($item[4] === true){
                    $slides .= '<div class="item">
                                <img src="'.$item[2].'">
                                <div class="carousel-caption">
                                  <h1 class="text-default">'.$item[0].'</h1>
                                  <p class="text-default">'.$item[1].'</p>
                                  <p><a href="'.$item[3].'"><button class="btn btn-info">Подробнее</button></a></p>
                                </div>
                            </div>';
                }
                else{
                    $slides .= '<div class="item">
                                    <img src="'.$item[2].'">
                                    <div class="carousel-caption">
                                        <h1>'.$item[0].'</h1>
                                        <p>'.$item[1].'</p>
                                        <p><a href="'.$item[3].'"><button class="btn btn-info">Подробнее</button></a></p>
                                    </div>
                                </div>';
                }
            }
            $i++;
            
        }
        $html .= $indicators.'</ol>';
        $html .= $slides.'</div>';
        $html .= '<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>';
        
        return $html;
    }
    
}
