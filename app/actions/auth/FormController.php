<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormController
 *
 * @author Anonymous
 */
class FormController extends \System\Controller {
    public function allowAccess() {
        return NULL;
    }
    public function post()
    {
        $ajax = new \System\Ajax();
        $form = new \Models\Forms\Login();
        $ajax->ajax_success($form->getArray());
        $this->setAjax($ajax);
    }
}
