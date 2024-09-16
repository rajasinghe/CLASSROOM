<?php

    $env = parse_ini_file('.env');
    //var_dump($env);
    foreach ($env as $key => $value) {
        putenv($key."=".$value);
    }

?>