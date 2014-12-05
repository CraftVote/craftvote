<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CError
 *
 * @author ishibkikh
 */
namespace System;

class Exception extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message, null, null);
        $this->message = $message;
        header($_SERVER['SERVER_PROTOCOL'].' 500 Internal Server Error');
        $config = \System\ApplicationRegistry::getConfig();
        if ($config->debug == 1){
            $this->showDebugInfo();
            exit();
        }
        else{
            error_log(" - ERROR - ".$this->getMessage().' ['.$this->getFile().':'.$this->getLine().']');
            $this->showPrivateInfo();
        }
    }

    protected function showPrivateInfo()
    {
        echo '<h2>Internal Server Error</h2>Please continue your work after a few minutes';
    }

    protected function showDebugInfo()
    {
        echo '<h2>Unexpected Error</h2><b>'.$this->getMessage().'</b><br>'.$this->file.' : '.$this->getLine().'<pre>'.$this->getTraceAsString().'</pre>';
    }
}