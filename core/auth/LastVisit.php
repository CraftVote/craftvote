<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth;

/**
 * Description of LastVisit
 *
 * @author ishibkikh
 */
class LastVisit {
    
    static public function isOnine($date){
        
        $date1 = \DateTime::createFromFormat('Y-m-d H:i:s', $date);
        $date2 = new \DateTime('NOW');
        
        $interval = $date1->diff($date2);
        if ($interval->format('%i') > 0){
            return false;
        }
        else {
            return true;
        }
    }
}
