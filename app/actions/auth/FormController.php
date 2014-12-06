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
class FormController extends \System\AjaxController {
    public function allowAccess() {
        return NULL;
    }
    public function get()
    {
        $form = new \Models\Forms\Login();
        $this->ajax_success($form->getArray());
    }
}
