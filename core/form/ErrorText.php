<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ComTextErrors
 *
 * @author ishibkikh
 */
namespace Form;

class ErrorText {
    
    static $lang = 'rus';

    static public function no_empty()
    {
        if (self::$lang === 'rus'){
            $message = 'поле не может быть пустым';
        }
        if (self::$lang === 'eng'){
            $message = 'required';
        }
        return $message;
    }
    
    static public function min_len($len)
    {
        $message = 'system: unknown language';
        if (self::$lang === 'rus'){
            $message = 'минимум '.$len.' символа(ов)';
        }
        if (self::$lang === 'eng'){
            $message = 'at least '.$len.' characters';
        }
        return $message;
    }
    
    static public function max_len($len)
    {
        $message = 'system: unknown language';
        if (self::$lang === 'rus'){
            $message = 'максимум '.$len.' символа(ов)';
        }
        if (self::$lang === 'eng'){
            $message = 'at most '.$len.' characters';
        }
        return $message;
    }
    
    static public function captcha()
    {
        $message = 'system: unknown language';
        if (self::$lang === 'rus'){
            $message = 'неверное значение';
        }
        if (self::$lang === 'eng'){
            $message = 'wrong value';
        }
        return $message;
    }
    
    static public function email()
    {
        $message = 'system: unknown language';
        if (self::$lang === 'rus'){
            $message = 'неверный E-mail адрес';
        }
        if (self::$lang === 'eng'){
            $message = 'invalid E-mail address';
        }
        return $message;
    }
    
    static public function fullname()
    {
        $message = '';
        if (self::$lang === 'rus'){
            $message = 'только буквенные слова';
        }
        if (self::$lang === 'eng'){
            $message = 'words with letters only';
        }
        return $message;
    }
    
    static public function numint()
    {
        $message = '';
        if (self::$lang === 'rus'){
            $message = 'только целое число';
        }
        if (self::$lang === 'eng'){
            $message = 'integer number only';
        }
        return $message;
    }
    
    static public function date()
    {
        $message = '';
        if (self::$lang === 'rus'){
            $message = 'неправильный формат даты';
        }
        if (self::$lang === 'eng'){
            $message = 'incorrect date format';
        }
        return $message;
    }
    
    static public function equalfield()
    {
        $message = '';
        if (self::$lang === 'rus'){
            $message = 'значение не совпадает';
        }
        if (self::$lang === 'eng'){
            $message = 'value does not match';
        }
        return $message;
    }
    
    static public function unique_db_field()
    {
        $message = '';
        if (self::$lang === 'rus'){
            $message = 'значение уже используется';
        }
        if (self::$lang === 'eng'){
            $message = 'value already exists';
        }
        return $message;
    }
}
