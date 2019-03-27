<?php
$request = $_SERVER['REDIRECT_URL'];
echo "INDEX";

switch ($request) {
    case '/' :
        require __DIR__ . '/views/index.php';
        break;
    case '' :
        require __DIR__ . '/views/index.php';
        break;
    case '/about' :
        require __DIR__ . '/views/about.php';
        break;
    case '/test' :
        require __DIR__ . '/views/test.php';
        break;
    default:
        require __DIR__ . '/views/404.php';
        break;
}