<?php

require 'once_requirements.php';
$request = $_SERVER['REDIRECT_URL'];

function rule ($request) {
    (new MainController($request))->execute();
}

$mysql = mysqli_connect('localhost', 'user', '', 'admin');
if(!$mysql){
    var_dump("Connot connect to db"); die;
}
rule($request);