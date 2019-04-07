<?php
require_once 'once_requirements.php';
$action = $_GET['action'];
switch ($action) {
    case 'usersTable':
        $usersModel = new UserModel();
        $users = $usersModel->executeQuery();
        header('Content-Type: Application/json');
        echo json_encode($users);
        break;
    case 'carsTable':
        $carsModel = new CarModel();
        $cars = $carsModel->executeQuery();
        header('Content-Type: Application/json');
        echo json_encode($cars);
        break;
    case 'transactionsTable':
        break;
    default:
        break;
}