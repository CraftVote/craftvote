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
        $this->template('balance');
        $this->write('REAL', $this->getParam('balance'));
        $this->write('BONUS', $this->getParam('bonus'));
        $this->write('OPERATIONS', $this->renderOperations($this->getParam('operations')));
    }
    
    protected function renderOperations($collection){
        
        if (count($collection) === 0){
            return '<p class="text-muted">Операций нет</p>';
        }
        $table = new \UI\Table();
        $table->striped();
        $table->bordered();
        $table->titles(['ID','Дата','Тип','Направление','Сумма','Комментарий']);
        foreach ($collection as $op){
            $table->addRow([$op->id,'<span class="time">'.$op->date_reg.'</span>',$op->type,$this->formatDirection($op->direction),$op->amount,$op->comment]);
        }
        return $table->getHtml();
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
