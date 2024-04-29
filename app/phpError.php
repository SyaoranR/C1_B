<?php
// error_reporting - Defines which errors are reported
// error_reporting(-1); supposed to show all errors
// ini_set('error_reporting',-1);
// this phpError is only recommended in delepment enviroment

const log = true;


function phpErr($err, $msg, $file, $line)
{

    switch ($err):
        case 2: // No such File
            $css = 'alert-warning';
            break;
        case 8: // Trying to get property of non-obj, in this case, id doesn't exist
            $css = 'alert-primary';
            break;
        case 1:
        case 256: // error at SQL Syntax
        case 2002: // SQLSTATE unknown Host at HOST =>
        case 1045: // SQLSTATE Access denied for user at USER =>
        case 1049: // SQLSTATE unknown Database at DB_NAME =>
            $css = 'alert-danger';
            break;
        default:
            $css = '';
    endswitch;

    echo "<p class=\"alert {$css} m-2\"><b>Error: </b>{$msg} <b>in file</b> {$file} <b>on line</b> <strong class=\"text-danger\">{$line}</strong></p>";

    // var_dump($err);

    if (log) :
        $logs = "Error: {$msg} in file {$file} on line {$line}\n";

        // error_log('Something seems wrong...', 3, 'ErrorLog.log');
        error_log($logs, 3, "" . dirname(__FILE__) . "/logs/ErrorLog.log");
    endif;

    if ($err == 1 || $err == 256) :
        die();
    endif;
}

set_error_handler('phpErr');
