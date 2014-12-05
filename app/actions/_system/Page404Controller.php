<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of page_not_found
 *
 * @author ishibkikh
 */
class Page404Controller extends \System\Controller {
    
    public function execute() {
        
        $this->responseCode(404);
        return true;
    }
    
    public function allowAccess() {
        return null;
    }
    
}
