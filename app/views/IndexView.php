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
        $this->title('Рейтинг проектов Minecraft');
        $this->pageHeader('Рейтинг проектов Minecraft');
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
            $this->renderProj($pr->title, $pr->description, $i, $pr->id, $pr->logo, $pr->rating, $pr->votes, $pr->visits);
            $i++;
        }
    }
    
    protected function renderProj($title, $description, $pos, $id, $logo, $rating, $votes, $visits){
        
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
                                    <h1 class="text-muted">'.$pos.'</h1><h3 class="text-warning">'.$kubok.'</h3>
                                </div>
                                <div class="col-xs-11">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <h3 class="text-default"><a class="noline" href="/project/'.$id.'">'.$title.'</a></h3>
                                        </div>
                                        <div class="col-sm-7"><a href="/project/'.$id.'"><img class="img-responsive img-rounded" src="/res/img/projects/'.$logo.'"></a></div>
                                    </div>  
                                    <small class="text-muted">'.$description.'</small>
                                </div>
                            </div>    
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-xs-6"><p class="text-muted"><small title="Рейтинг"><span class="glyphicon glyphicon-stats"></span> '.$rating.'</small> | <small title="Голосов"><span class="glyphicon glyphicon-heart"></span> '.$votes.'</small> | <small title="Просмотров"><span class="glyphicon glyphicon-eye-open"></span> '.$visits.'</small> | <small title="Отзывов"><span class="glyphicon glyphicon-comment"></span> 0</small></p></div>
                                <div class="col-xs-6 text-right"><button onclick="voteProject(\''.$id.'\');" class="btn btn-success btn-xs btn-width-md">Голосовать</button></div>
                            </div>    
                        </div>
                    </div>');
    }
}
