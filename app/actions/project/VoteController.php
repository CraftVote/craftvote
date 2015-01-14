<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VoteController
 *
 * @author ishibkikh
 */
class VoteController extends \System\Controller {
    
    
    public function post(){
        
        $ajax = new \System\Ajax();
        $member = \Custom\VK::authOpenAPIMember();
        if($member !== FALSE) {
            $vk_id = $member['id'];
            $project_id = filter_input(INPUT_POST, 'pr', FILTER_SANITIZE_NUMBER_INT);
            $ip = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_SANITIZE_STRING);
            $votes = new \Models\Tables\Votes();
            $mapper = new \DB\MySQL\DataMapper($votes);
            if (!$mapper->findOneByField('vk_id', $vk_id)){
                $votes->ip = $ip;
                $votes->project_id = $project_id;
                $votes->vk_id = $vk_id;
                $mapper->save();
                \Custom\Project::increaseVotes($project_id);
                $ajax->ajax_popup('Успешно', 'Ваш голос засчитан');
                $this->setAjax($ajax);
                return;
            }
            else{
                if (\System\Time::diffDays($votes->date) > 0){
                    $votes->clear();
                    $votes->ip = $ip;
                    $votes->project_id = $project_id;
                    $votes->vk_id = $vk_id;
                    $mapper->insert();
                    \Custom\Project::increaseVotes($project_id);
                    $ajax->ajax_popup('Успешно', 'Ваш голос засчитан');
                    $this->setAjax($ajax);
                    return;
                }
            }
            if (!$mapper->findOneByField('ip', $ip)){
                $votes->clear();
                $votes->ip = $ip;
                $votes->project_id = $project_id;
                $votes->vk_id = $vk_id;
                $mapper->insert();
                \Custom\Project::increaseVotes($project_id);
                $ajax->ajax_popup('Успешно', 'Ваш голос засчитан');
                $this->setAjax($ajax);
                return;
            }
            else{
                if (\System\Time::diffDays($votes->date) > 0){
                    $votes->clear();
                    $votes->ip = $ip;
                    $votes->project_id = $project_id;
                    $votes->vk_id = $vk_id;
                    $mapper->insert();
                    \Custom\Project::increaseVotes($project_id);
                    $ajax->ajax_popup('Успешно', 'Ваш голос засчитан');
                    $this->setAjax($ajax);
                    return;
                }
            }
            $ajax->ajax_popup('Ошибка', 'Можно голосовать только 1 раз в сутки');
            
        } else { 
            $ajax->ajax_popup('Ошибка', 'Не удаётся проголосовать');
        }
        $this->setAjax($ajax);
    }
    
    public function allowAccess() {
        return NULL;
    }
    
    
}
