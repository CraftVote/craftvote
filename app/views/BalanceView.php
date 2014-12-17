<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BalanceView
 *
 * @author ishibkikh
 */
class BalanceView extends \System\HtmlView {
    
    public function execute() {
        $this->layout('general');
        $this->title('Информация о счёте');
        $this->pageHeader('Информация о счёте');
        $this->h3('Остаток');
        $this->p_muted('Основные средства: <b class="text-default">'.$this->getParam('balance').'</b> руб');
        $this->p_muted('Бонусы: <b class="text-default">'.$this->getParam('bonus').'</b> руб');
        $this->hr();
        $this->h3('Последние 10 операций');
        $this->renderOperations($this->getParam('operations'));
    }
    
    protected function renderOperations($operations){
        
        if ($operations === false){
            $this->p_muted('Операций нет');
            return;
        }
        //\System\Damp::variable($operations);
        //exit;
        $table = new \UI\Table();
        $table->striped();
        $table->bordered();
        $table->titles(['ID','Дата','Тип','Направление','Сумма','Комментарий']);
        foreach ($operations as $op){
            $table->addRow([$op[0],$op[2],$op[3],$this->formatDirection($op[6]),$op[4],$op[5]]);
        }
        $this->body($table);
    }
    
    protected function formatDirection($direction){
        if ($direction === 'IN'){
            return 'зачисление';
        }
        if ($direction === 'OUT'){
            return 'списание';
        }
        return 'unknown';
    }
}
