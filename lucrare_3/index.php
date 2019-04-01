<?php

require 'once_requirements.php';
require_once 'Views/templates/header.html';
require 'Views/UserCreator.php';
$request = $_SERVER['REQUEST_URI'];

function rule ($request) {
    (new MainController($request))->execute();
}

rule($request);