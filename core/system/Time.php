<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace System;

/**
 * Description of Time
 *
 * @author ishibkikh
 */
class Time {
    
    static public function formatDateTime($input){
        
        $date1 = \DateTime::createFromFormat('Y-m-d H:i:s', $input);
        $date2 = new \DateTime('NOW');
        
        $interval = $date1->diff($date2);
        
        
        $years = $interval->format('%Y');
                
        if ($years == 0){
            $days = $interval->format('%d');
            $h1 = $date1->format('H');
            $m1 = $date1->format('i');
            if ($$days < 2){
                $h2 = $date2->format('H');
                $m2 = $date2->format('i');
                $s1 = $date1->format('s');
                $s2 = $date2->format('s');
            }
            
            if ($days == 1){
                if (($h1 > $h2)or(($h1 == $h2)and($m1 > $m2))or(($h1 == $h2)and($m1 == $m2)and($s1 > $s2))){
                    return $date1->format('d').' '.  self::numToMonth($date1->format('n')).' в '.$h1.':'.$m1;
                }
                return 'вчера в '.$date1->format('H').':'.$date1->format('i');
            }
            if ($days == 0){
                if (($h1 > $h2)or(($h1 == $h2)and($m1 > $m2))or(($h1 == $h2)and($m1 == $m2)and($s1 > $s2))){
                    return 'вчера в '.$h1.':'.$m1;
                }
                return 'сегодня в '.$h1.':'.$m1;
            }
            return $date1->format('d').' '.  self::numToMonth($date1->format('n')).' в '.$h1.':'.$m1;
        }
        else {
            return $date1->format('d').' '.self::numToMonth($date1->format('n')).' '.$date1->format('Y');
        }
    }
    
    static protected function numToMonth($num){
        switch ($num){
            case 1: return 'января';
            case 2: return 'февраля';
            case 3: return 'марта';
            case 4: return 'апреля';
            case 5: return 'мая';
            case 6: return 'июня';
            case 7: return 'июля';
            case 8: return 'августа';
            case 9: return 'сентября';
            case 10: return 'октября';
            case 11: return 'ноября';
            case 12: return 'декабря';
        }
    }
}
