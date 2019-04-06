<?php

require_once 'once_requirements.php';
$action = $_POST['action'];
if ($action === 'usersSearch') {
    $usersModel = new UserModel();
    $usersModel->setFilters($_POST);
    $users = $usersModel->executeQuery();
    header('Content-Type: Application/json');
    echo json_encode($users);
    exit;
}