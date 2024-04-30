<?php
/* 
 * __FILE__ Magic Const. returns complete path and file's
 * name, dirname - returns path from father dir
 * define and const - constant definition
 * consts may be changed after declaration
 */

// define('db', [
//     'HOST' => 'localhost',
//     'USER' => 'root',
//     'PASS' => '',
//     'DB_NAME' => 'c1_b',
//     'PORT' => '3306'
// ]); OR BELOW

const db = [
    'HOST' => 'localhost',
    'USER' => 'root',
    'PASS' => '',
    'DB_NAME' => 'c1_b',
    'PORT' => '3306'
];

//define('HOST', 'localhost');
//define('USER', 'root');
//define('PASS', '');
//define('DB_NAME', 'c1_b');
//define('PORT', '3306');

define('APP', dirname(__FILE__));

define('URL', 'http://localhost/C1_B');

define('APP_NAME', 'Object Oriented PHP7 and MVC Course');

const APP_VER = '1.2.0';

/* 
 * echo __FILE__;
 * echo dirname(__FILE__);
 * echo dirname(dirname(__FILE__));
 */