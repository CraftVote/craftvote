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
        
        $member = \Custom\VK::authOpenAPIMember();
        $ajax = new \System\Ajax();
        if($member !== FALSE) {
            $vk_id = $member['id'];
            $project_id = filter_input(INPUT_POST, 'pr', FILTER_SANITIZE_NUMBER_INT);
            $ip = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_SANITIZE_STRING);
            
            $votes = new \Models\Tables\Votes();
            $mapper = new \DB\MySQL\DataMapper($votes);
            
            if (!$mapper->findOneByField('ip', $ip)){
                $is_ip = false;
            }
            else{
                $is_ip = true;
                $ip_day_over = (\System\Time::diffDays($votes->date) > 0);
            }
            if (!$mapper->findOneByField('vk_id', $vk_id)){
                $is_vk_id = false;
            }
            else{
                $is_vk_id = true;
                $vk_id_day_over = (\System\Time::diffDays($votes->date) > 0);
            }
            
            
            if ($is_ip){
                if ($ip_day_over){
                    if ($is_vk_id){
                        if ($vk_id_day_over){
                            $this->vote($project_id, $vk_id);
                            return;
                        }
                    }
                    else{
                        $this->vote($project_id, $vk_id);
                        return;
                    }
                }
            }
            else{
                if ($is_vk_id){
                    if ($vk_id_day_over){
                        $this->vote($project_id, $vk_id);
                        return;
                    }
                }
                else{
                    $this->vote($project_id, $vk_id);
                    return;
                }
            }
            $ajax->ajax_popup('Ошибка', 'Можно голосовать только 1 раз в сутки с одного устройства');
            
        } else { 
            $ajax->ajax_popup('Ошибка', 'Не удаётся проголосовать');
        }
        $this->setAjax($ajax);
    }
    
    
    protected function vote($project_id, $vk_id){
        
        $ajax = new \System\Ajax();
        $votes = new \Models\Tables\Votes();
        $mapper = new \DB\MySQL\DataMapper($votes);
        $votes->ip = filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_SANITIZE_STRING);
        $votes->project_id = $project_id;
        $votes->vk_id = $vk_id;
        $mapper->insert();
        \Custom\Project::increaseVotes($project_id);
        $ajax->ajax_popup('Голос принят', 'Ваш голос успешно добавлен к остальным голосам проекта');
        $this->setAjax($ajax);
    }


    public function allowAccess() {
        return NULL;
    }
    
    
}
