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
class Page401Controller extends \System\Controller {
    
    public function get() {
        
        $this->responseCode(401);
        return true;
    }
    
    public function allowAccess() {
        return null;
    }
    
}
