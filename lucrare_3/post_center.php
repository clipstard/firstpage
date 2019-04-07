<?php

require_once 'once_requirements.php';
$action = $_POST['action'];
switch ($action) {
    case 'searchUsers':
        $usersModel = new UserModel();
        $usersModel->setFilters($_POST);
        $users = $usersModel->executeQuery();
        header('Content-Type: Application/json');
        echo json_encode($users);
        break;
    case 'createUser':
        $usersModel = new UserModel();
        $response = [];
        ($usersModel->flushUser($usersModel->createEntity($_POST))) ? $response = ['code' => 201, 'status' => 'success'] : $response = ['code' => 400, 'status' => 'error'];
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
    case 'deleteUser':
        $usersModel = new UserModel();
        $deleteResult = $usersModel->deleteUser($_POST);
        $response = ($deleteResult) ? ['code' => 200, 'status' => 'success'] : ['code' => 400, 'status' => 'error'];
        echo json_encode($response);
        break;
    case 'searchCars':
        $carModel = new CarModel();
        $carModel->setFilters($_POST);
        $cars = $carModel->executeQuery();
        header('Content-Type: Application/json');
        echo json_encode($cars);
        break;
    case 'createCar':
        $carModel = new CarModel();
        $response = [];
        ($carModel->flushCar($carModel->createEntity($_POST))) ? $response = ['code' => 201, 'status' => 'success'] : $response = ['code' => 400, 'status' => 'error'];
        header('Content-Type: Application/json');
        echo json_encode($response);
        break;
    case 'updateCar':
        $carModel = new CarModel();
        $updateResult = $carModel->updateCar($_POST);
        $response = [];
        ($updateResult) ? $response = ['code' => 200, 'status' => 'success'] : $response = ['code' => 400, 'status' => 'error'];
        echo json_encode($response);
        break;
    case 'deleteCar':
        $carModel = new CarModel();
        $deleteResult = $carModel->deleteCar($_POST);
        $response = ($deleteResult) ? ['code' => 200, 'status' => 'success'] : ['code' => 400, 'status' => 'error'];
        echo json_encode($response);
        break;
    default:
        break;
}

