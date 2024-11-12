<?php
// error_reporting - Defines which errors are reported
// error_reporting(-1); supposed to show all errors
// ini_set('error_reporting',-1);

const log = true;


function phpErr($err, $msg, $arq, $line)
{

    switch ($err):
        case 2:
            $css = 'alert-warning';
            break;
        case 8:
            $css = 'alert-primary';
            break;
        case 1:
        case 256:
        case 2002:
        case 1045:
        case 1049:
            $css = 'alert-danger';
            break;
        default:
            $css = '';
    endswitch;

    echo "<p class=\"alert {$css} m-2\"><b>Error: </b>{$msg} <b>at file</b> {$arq} <b>in the line</b> <strong class=\"text-danger\">{$line}</strong></p>";

    // var_dump($err);

    if (log) :
        $logs = "Error: {$msg} at file {$arq} in the line {$line}\n";

        // error_log('Something seems wrong...', 3, 'ErrorLog.log');
        error_log($logs, 3, "" . dirname(__FILE__) . "/logs/ErrorLog.log");
    endif;

    if ($err == 1 || $err == 256) :
        die();
    endif;
}

set_error_handler('phpErr');
