<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProfilebgView
 *
 * @author ishibkikh
 */
class ProfilebgView extends \System\View{
    
    public function execute() {
        $this->body('<img class="img-responsive user-bgimage pull-center" src="<!--USERBG-->">');
    }
}
