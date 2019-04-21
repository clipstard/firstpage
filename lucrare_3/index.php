<?php
$request = $_SERVER['REQUEST_URI'];

if (explode('/', $request)[1] === 'api') {
    require 'api_center.php';
    die;
}
require 'once_requirements.php';
require_once 'Views/templates/header.html';

$request = $_SERVER['REQUEST_URI'];

function rule($request)
{
    $entity = explode('/', $request);
    $parts = [];
    for ($i = 1; $i < count($entity); $i++)
        $parts[] = $entity[$i];
    if (in_array($parts[0], array('users', 'cars', 'transactions'))) {
        (new ShowController($parts[0]))->execute();
    } else
        (new MainController($request))->execute();
}

function cureRequest($request)
{
    $str = str_split($request);
    $c = 0;
    foreach ($str as $item) {
        if ($item === '?') break;
        $c++;
    }
    if ($c) return substr($request, 0, $c);
    else return $request;
}

function getResource($request)
{
    $str = str_split($request);
    $c = 0;
    foreach ($str as $item) {
        if ($item === '?') break;
        $c++;
    }
    if ($c) return substr($request, $c + 1);
    else return null;
}

rule($request);

require_once 'Views/templates/footer.html';