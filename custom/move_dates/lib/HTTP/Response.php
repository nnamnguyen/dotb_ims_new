<?php

namespace HTTP;

class Response {
    
    public static function exitMessage($message, $code){
        header("HTTP/1.0 {$code} {$message}");
		print "$message\n";
		exit();
    }
    
}
