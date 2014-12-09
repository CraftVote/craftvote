<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RightbannerView
 *
 * @author ishibkikh
 */
class RightbannerView extends \System\HtmlView {
    
    public function execute() {
        $this->body('<div class="text-center"><p><small class="text-muted">Реклама</small></p></div>');
        $this->img('/res/img/banners/rightbanner.png', 'banner');
    }
}
