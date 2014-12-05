<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace System;

/**
 * Description of Transmitter
 *
 * @author Ivan
 */
class Transmitter {
    
    public function __construct(\System\CommandContext $request) {
        define('APP_STOP_TIMESTAMP', microtime(true));
        if ($request->getRedirection() === null){
            $this->sendResponseCode($request->getResponseCode());
            $this->sendContentType($request->getContentType(), $request->getCharset());
            if (($request->getContentType() === 'application/json')and(is_array($request->getBuffer()))){
                echo json_encode($request->getBuffer());
            }
            else{
                echo $request->getBuffer();
            }
        }
        else {
            header("Location: ".$request->getRedirection());
        }
    }
    
    private function sendResponseCode($code){
        switch (intval($code))
        {
            case 301: $message = '301 Moved Permanently'; break;
            case 302: $message = '302 Moved Temporarily'; break;
            case 400: $message = '400 Bad Request'; break;
            case 401: $message = '401 Unauthorized'; break;
            case 403: $message = '403 Forbidden'; break;
            case 404: $message = '404 Not Found'; break;
            case 500: $message = '500 Internal Server Error'; break;
            default:  $message = '200 OK';
        }
        header($_SERVER['SERVER_PROTOCOL'].' '.$message);
    }
    
    private function sendContentType($contentType, $charset){
        
        header('Content-Type: '.$contentType.';charset='.$charset);
        
        /*
        switch ($type)
        {
            case "html": header('Content-Type: text/html;charset=utf-8'); break;
            case "text": header('Content-Type: text/plain;charset=utf-8'); break;
            case "xhtml": header('Content-Type: application/xhtml+xml;charset=utf-8'); break;
            case "xml": header('Content-Type: text/xml;charset=utf-8'); break;
            case "json": header('Content-Type: application/json;charset=utf-8'); break;
            case "jpeg": header('Content-Type: image/jpeg'); break;
            default: header('Content-Type: text/html;charset=utf-8'); break;
        }
         * 
         */
    }
}
