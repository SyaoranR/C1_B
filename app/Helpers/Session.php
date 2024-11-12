<?php

/**
 * Users' Sessions
 * 
 * @author Alessandro Fraga Gomes
 * @copyright 2021-2024 Php7 Alex
 * @version 1.1.1
 */

class Session {

    public static function msg($name, $text = null, $class = null) {

        if(!empty($name)):         
            if(!empty($text) && empty($_SESSION[$name])): 
                if(!empty($_SESSION[$name])): 
                    unset($_SESSION[$name]); 
                endif;
                
                $_SESSION[$name] = $text;
                $_SESSION[$name.'class'] = $class;

                elseif(!empty($_SESSION[$name]) && empty($text)):
                    $class = !empty($_SESSION[$name.'class']) ?  $_SESSION[$name.'class'] : 'alert alert-success';
                    echo '<div class="'.$class.'">'.$_SESSION[$name].'</div>';

                    unset($_SESSION[$name]);
                    unset($_SESSION[$name.'class']);
            endif;
        endif;

    }

    public static function logged(){
        if (isset($_SESSION['user_id'])) :
            return true;
        else:
            return false;
        endif;
    }

}