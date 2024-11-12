<?php

/**
 * Friendly Urls and redirect, summerizing texts and showing current Date
 *  
 * @author Alessandro Fraga Gomes
 * @copyright 2021-2024 Php7 Alex
 * @version 1.1.1
 */

class Url {

    public static function redirect($url){
        // sends header HTTP, separator = '/'
        header("Location:".URL.DIRECTORY_SEPARATOR.$url);
    }

    /**
     * Turns into a string in Friendly URL form and returns a converted string
     * @param string $str any $string
     * @return string A valid friendly URL
     */

    public static function friendlyUrl($str) {

        $map = [];
        $map['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
        $map['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';
        $url = strtr(utf8_decode($str), utf8_decode($map['a']), $map['b']);
        $url = strip_tags(trim($url));
        $url = str_replace(' ', '-', $url);
        $url = str_replace(['-----', '----', '---', '--'], '-', $url);

        return strtolower(utf8_decode($url));
    }


    /**
     * Summerizing texts
     */

    public static function textSummerize ($txt, $limit, $continue = null) {
        
        /* 
        // $text = $txt;
        $text = strip_tags(trim($txt));

        echo '<hr>';
        var_dump($text);
        echo '<hr>';
        
        */

        $text = strip_tags(trim($txt));
        $limitation = (int) $limit;

        // params ($delimiter, $string)
        $arr = explode(' ', $text);
        $totalWords = count($arr);
        // params ($delimiter, $pieces) 
        // array_slice extract each piece params ($arr, $offset, $length) starting and ending point
        $summerizedText = implode(' ', array_slice($arr, 0, $limitation));

        $cont = (empty($continue) ? ' ...' : ''.$continue);
        $result = ($limitation < $totalWords ? $summerizedText.$cont : $text);

        return $result;

        // Comment this
        echo '<hr>';
        var_dump($arr, $totalWords);
        echo '<hr>';  
        // Comment this      

    }

    /**
     * Shows us the current Date
     */

    public static function currentDate () {
        $dayMonth = date('d');
        $dayWeek = date('w');
        $month = date('n') - 1;
        $year = date('Y');

        $weekName = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

        $monthName = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        return $weekName[$dayWeek].', ' .$dayMonth. ' of ' .$monthName[$month]. ' of ' .$year;
    }

}