<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProfileView
 *
 * @author ishibkikh
 */
class ProfileView extends \System\HtmlView {
    
    public function execute() {
        
        $user = $this->getParam('user');
        $mine = $this->getParam('mine');
        
        $this->layout('general');
        $this->title('Профиль');
        $this->template('profile');
        $this->setRegButton($mine);
        $this->setUserInfo($user);
    }
    
    protected function setUserInfo(\Models\Tables\Users $user){
        $this->write('NAME', $user->name);
        $this->write('DATEREG', $user->date_create);
        $this->write('DATEVISIT', \System\Session::getLastVisitDate($user->session));
        $this->write('ROLE', $user->role);
    }
    
    protected function setRegButton($mine){
        if ($mine === TRUE){
            $this->write('REGBUTTON', '<p class="align-bottom"><a href="/editprofile"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Редактировать</a></p>');
        }
    }
}
