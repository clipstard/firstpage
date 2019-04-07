<?php

require_once 'once_requirements.php';
$action = $_POST['action'];
switch ($action) {
    case 'showUsers':
        $usersModel = new UserModel();
        $usersModel->setFilters($_POST);
        $users = $usersModel->executeQuery();
        header('Content-Type: Application/json');
        echo json_encode($users);
        break;
    case 'createUser':
        $usersModel = new UserModel();
        $response = [];
        ($usersModel->flushUser($usersModel->createEntity($_POST))) ? $response = ['code' => 201, 'status' => 'success'] :  $response = ['code' => 400, 'status' => 'error'];
        header('Content-Type: Application/json');
        echo json_encode($response);
        break;
    case 'updateUser':
        $usersModel = new UserModel();
        $updateResult = $usersModel->updateUser($_POST);
        $response = [];
        ($updateResult) ? $response = ['code' => 200, 'status' => 'success'] : $response = ['code' => 400, 'status' => 'error'];
        echo json_encode($response);
        break;
    case'deleteUser':
        $usersModel = new UserModel();
        $deleteResult = $usersModel->deleteUser($_POST);
        $response = ($deleteResult) ? ['code' => 200, 'status' => 'success'] : ['code' => 400, 'status' => 'error'];
        echo json_encode($response);
        break;
    default:
        break;
}

