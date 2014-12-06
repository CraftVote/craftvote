<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ComValid
 *
 * @author ishibkikh
 */
namespace Form;

class VerifyField {
    
    static public function email($text)
    {
        if(filter_var($text, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        else {
            return false;
        }
    }
    
    static public function address($text)
    {
        if(filter_var($text, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^([-., \w\/]+)$/u")))){
            return true;
        }
        else {
            return false;
        }
    }
    
    static public function tel($text)
    {
        if(filter_var($text, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^([-+() 0-9]+)$/")))){
            return true;
        }
        else {
            return false;
        }
    }
    
    static public function fullname($text)
    {
        if(filter_var($text, FILTER_VALIDATE_REGEXP, array("options"=>array('regexp'=>"/^([a-zA-Zа-яА-ЯёЁ]+)( )?([a-zA-Zа-яА-ЯёЁ]+)*( )?([a-zA-Zа-яА-ЯёЁ]+)*/")))){
            return true;
        }
        else {
            return false;
        }
    }
    
    static public function anum($text)
    {
        if(filter_var($text, FILTER_VALIDATE_REGEXP, array("options"=>array('regexp'=>"/^([a-z][-_0-9a-z]+)$/")))){
            return true;
        }
        else {
            return false;
        }
    }
    
    static public function numint($text)
    {
        if(filter_var($text, FILTER_VALIDATE_INT)){
            return true;
        }
        else {
            return false;
        }
    }
    
    static public function numdec($text)
    {
        if(filter_var($text, FILTER_VALIDATE_FLOAT)){
            return true;
        }
        else {
            return false;
        }
    }
    
    static public function bool($text)
    {
        return filter_var($text, FILTER_VALIDATE_BOOLEAN);
    }
    
    static public function minlen($text, $min)
    {
        if (mb_strlen($text, 'UTF-8') < intval($min)){
            return false;
        }
        else {
            return true;
        }
            
    }
    
    static public function maxlen($text, $max)
    {
        if (mb_strlen($text, 'UTF-8') > intval($max)){
            return false;
        }
        else {
            return true;
        }
            
    }
    
    static public function noempty($text)
    {
        if (strlen($text) > 0){
            return true;
        }
        else {
            return false;
        }
            
    }
    
    static public function date($value)
    {
        if (strtotime($value)){
            return true;
        }
        else {
            return false;
        }
    }
    
    static public function captcha($input){
        if (session_status() === PHP_SESSION_NONE){
            session_start();
        }
        return ($input === $_SESSION['captcha']);
    }

    
    static public function dir($text)
    {
        if (is_dir($text)){
            return true;
        }
        else {
            return false;
        }
    }
    
    static public function equalfield($value, $compare_field_value)
    {
        if($value === $compare_field_value){
            return true;
        }
        else {
            return false;
        }
    }
    
    static public function unique_db_field($value, $table, $field)
    {
        $req = new \DB\SQL\RequestBuilder(\DB\SQL\MySqlConnector::getInstance());
        $result = $req->select('*')->from($table)->where(array($field => $value))->fetchOne();
        
        if(!$result){
            return true;
        }
        else {
            return false;
        }
    }
    
}
