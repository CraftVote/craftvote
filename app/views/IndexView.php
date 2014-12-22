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
        
        $this->layout('general');
        $this->title('Рейтинг проектов Warcraft');
        $this->pageHeader('Рейтинг проектов Warcraft');
        $this->renderProjects($this->getParam('items'));
    }
    
    protected function renderProjects($collection){
        
        if (count($collection) === 0){
            $this->p_muted('Проекты не найдены');
            return;
        }
        
        $i = 1;
        foreach ($collection as $pr){
            if ($pr->logo == NULL){
                $pr->logo = 'default.png';
            }
            $this->renderProj($pr->title, $pr->description, $i, $pr->id, $pr->logo, $pr->rating);
            $i++;
        }
    }
    
    protected function renderProj($title, $description, $pos, $id, $logo, $rating){
        
        if ($pos === 1){
            $kubok = '<i class="fa fa-trophy"></i>';
        }
        else{
            $kubok = '';
        }
        $this->body('<div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-1 text-top">
                                    <h1 class="text-primary">'.$pos.$kubok.'</h1>
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
