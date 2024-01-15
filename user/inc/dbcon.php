<?php

    // $hostname = 'localhost';
    // $dbuserid = 'jhjh3373jh';
    // $dbpasswd = 'cpfl**10';
    // $dbname = 'jhjh3373jh';
    $hostname = 'localhost';
    $dbuserid = 'coderabbit';
    $dbpasswd = 'rabbit9595!!';
    $dbname = 'coderabbit';

    $mysqli = new mysqli($hostname, $dbuserid, $dbpasswd, $dbname);

    if ($mysqli->connect_errno) {
    die('mysqli connection error: ' . $mysqli->connect_error);
    } 

?>