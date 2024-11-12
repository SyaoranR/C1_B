<?php

/**
 * Checkers (username and email)
 * Date Format (Brazilian format)
 * 
 * @author Alessandro Fraga Gomes
 * @copyright 2021-2024 Php7 Alex
 * @version 1.1.1
 */
 

class Check {

    // regex101.com /[a-z A-Z]+/m
    public static function nameCheck($username){
        if(!preg_match('/^([áÁàÀãÃâÂéÉèÈêÊíÍìÌóÓòÒõÕôÔúÚùÙçÇaA-zZ]+)+((\s[áÁàÀãÃâÂéÉèÈêÊíÍìÌóÓòÒõÕôÔúÚùÙçÇaA-zZ]+)+)?$/', $username)):
            return true;
        else:
            return false;
        endif;        
    }

    public static function emailCheck($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
            return true;
        else:
            return false;
        endif;
    }

    public static function brDate($data) {
        if(isset($data)):
            return date('d/m/Y H:i', strtotime($data));
        else:
            return false;
        endif;
    }

}