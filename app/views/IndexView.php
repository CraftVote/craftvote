<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HelloworldView
 *
 * @author ishibkikh
 */
class IndexView extends \System\HtmlView {
    
    public function execute() {
        
        $time = $this->getParam('time');
        $this->layout('general');
        $this->title('Рейтинг проектов Warcraft');
        $this->pageHeader('Рейтинг проектов Warcraft');
        $this->renderProjects($this->getParam('items'));
    }
    
    protected function renderProjects($items){
        
        if ($items === FALSE){
            $this->p_muted('Проекты не найдены');
            return;
        }
        
        $i = 1;
        foreach ($items as $pr){
            if ($pr[8] == NULL){
                $pr[8] = 'default.png';
            }
            $this->renderProj($pr[1], $pr[2], $i, $pr[0], $pr[8], $pr[9]);
            $i++;
        }
    }
    
    protected function renderProj($title, $description, $pos, $id, $logo, $rating){
        
        $this->body('<div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-1 text-top">
                                    <h2 class="text-primary">'.$pos.'</h2>
                                </div>
                                <div class="col-xs-11">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <h3 class="text-default">'.$title.'</h3>
                                        </div>
                                        <div class="col-sm-7"><img class="img-responsive img-rounded" src="/res/img/projects/'.$logo.'"></div>
                                    </div>  
                                    <small class="text-muted">'.$description.'</small>
                                </div>
                            </div>    
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-xs-6"><p class="text-muted"><small><span class="glyphicon glyphicon-stats"></span> '.$rating.'</small> | <small><span class="glyphicon glyphicon-eye-open"></span> 1149</small> | <small><span class="glyphicon glyphicon-heart"></span> 45</small></p></div>
                                <div class="col-xs-6 text-right"><button class="btn btn-success btn-xs btn-width-md">Голосовать</button></div>
                            </div>    
                        </div>
                    </div>');
    }
}
