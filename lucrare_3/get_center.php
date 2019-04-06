<?php
require_once 'once_requirements.php';
$action = $_GET['action'];
if ($action === 'usersTable') {
    $usersModel = new UserModel();
    $users = $usersModel->executeQuery();
    header('Content-Type: Application/json');
    echo json_encode($users);
    exit;
}