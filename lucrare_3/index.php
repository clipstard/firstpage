<?php

require 'once_requirements.php';
require_once 'Views/templates/header.html';

$request = $_SERVER['REQUEST_URI'];
function rule ($request) {
    if (cureRequest($request) === '/show'){
        (new ShowController($request))->execute();
    } else
        (new MainController($request))->execute();
}

function cureRequest($request) {
    $str = str_split($request);
    $c = 0;
    foreach($str as $item) {
        if ($item === '?') break;
        $c++;
    }
    if ($c) return substr($request, 0, $c);
    else return $request;
}


rule($request);