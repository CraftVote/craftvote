<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author ishibkikh
 */
class IndexController extends \System\Controller {
    
    public function get() {
        
        $this->setParam('items', \Custom\Project::getActive());
    }
    
    public function allowAccess() {
        return NULL;
    }
    
}
