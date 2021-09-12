<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace HTTP;

/**
 * Description of Request
 *
 * @author donuc.ileni
 */
class Request {
    
    public static function requireMethodPost(){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Response::exitMessage('Invalid method. POST is required', 501);
        }
    }
    
}
