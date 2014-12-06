<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ComFormatValue
 *
 * @author ishibkikh
 */
namespace Form;

class StringFormater {
    
    static public function format($value, $action)
    {
        switch ($action){
            case 'trim' : return trim($value);
            case 'upperfirstletters' : return ucwords(strtolower($value));
            case 'lowercase' : return strtolower($value);
            case 'uppercase' : return strtoupper($value);
            case 'hash256' : return ComSecurity::hash256($value);
            case 'hash512' : return ComSecurity::hash512($value);
        }
    }
    
}
