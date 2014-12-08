<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ComVarDamp
 *
 * @author ishibkikh
 */
namespace System;


class Damp {
    
    static public function variable($expression, $format=false)
    {
        if (!$format){
            echo '<pre>';
            var_dump($expression);
            echo '</pre>';
        }
        else{
            
            print_r($expression);
            
        }
    }
    
}
