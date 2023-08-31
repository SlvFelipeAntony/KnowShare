<?php

function newConnection($base = 'knowshare'){
    $server = 'localhost';
    $user = 'root';
    $password = '';

    $connection = new mysqli($server, $user, $password, $base);

    if($connection -> connect_error){
        die('Erro: ' . $connection -> connect_error);
    }
    return $connection;
}