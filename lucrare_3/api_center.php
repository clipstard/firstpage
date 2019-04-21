<?php
require_once 'once_requirements.php';
$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$component = explode('/', $request)[2];
$id = explode('/', $request)[3];
switch ($method) {
    case 'GET':
        filterget();
        switch ($component) {
            case 'users':
                if ($id && (int)trim($id) == trim($id)) {
                    $users = (new UserModel())
                        ->setFilters(['id' => (int)$id])
                        ->executeQuery();
                } else {
                    $users = (new UserModel())
                        ->setFilters($_GET)
                        ->executeQuery();
                }
                header('Content-Type: Application/json');
                echo json_encode($users);
                die;
            case 'cars':
                if (count(explode('/', $request)) > 3) {
                    $cars = (new CarModel())->setFilters($_GET)->executeQuery();
                    header('Content-Type: Application/json');
                    echo json_encode($cars);
                } else (new ShowController($component))->execute();
                die;
            case 'transactions':
                if (count(explode('/', $request)) > 3) {
                    $transactions = (new TransactionModel())->setFilters($_GET)->executeQuery();
                    header('Content-Type: Application/json');
                    echo json_encode($transactions);
                } else (new ShowController($component))->execute();
                die;
            default:
                (new MainController($request))->execute();
        }
        break;
    case 'POST':
        switch ($component) {
            case 'users':
                $usersModel = new UserModel();
                $response =($usersModel->flushUser($usersModel->createEntity($_POST))) ? ['code' => 201, 'status' => 'success'] : ['code' => 400, 'status' => 'error'];
                header('Content-Type: Application/json');
                echo json_encode($response);
                break;

            case 'cars':
                $carsModel = new CarModel();
                $response = ($carsModel->flushCar($carsModel->createEntity($_POST))) ?  ['code' => 201, 'status' => 'success'] : ['code' => 400, 'status' => 'error'];
                header('Content-Type: Application/json');
                echo json_encode($response);
                break;

            case 'transactions':
                $transactionsModel = new TransactionModel();
                $response = ($transactionsModel->flushTransaction($transactionsModel->createEntity($_POST))) ? ['code' => 201, 'status' => 'success'] : ['code' => 400, 'status' => 'error'];
                header('Content-Type: Application/json');
                echo json_encode($response);
                break;
            default:
                break;
        }
        break;
    case 'PUT':
        $_PUT = sanitizeData();
        switch ($component) {
            case 'users':
                if ($id && (int)trim($id) == trim($id)) {
                    $result = (new UserModel())->updateUser($id, $_PUT);
                    $response  = ($result) ? ['status' => 'success', 'code' => 200] : ['status' => 'error', 'code' => 406];
                } else $response = ['status' => 'error', 'code' => 401];
                header('Content-Type: Application/json');
                echo json_encode($response);
                break;
            case 'cars':
                if ($id && (int)trim($id) == trim($id)) {
                    $result = (new CarModel())->updateCar($id, $_PUT);
                    $response  = ($result) ? ['status' => 'success', 'code' => 200] : ['status' => 'error', 'code' => 406];
                } else $response = ['status' => 'error', 'code' => 400];
                header('Content-Type: Application/json');
                echo json_encode($response);
                break;
            case 'transactions':
                if ($id && (int)trim($id) == trim($id)) {
                    $result = (new TransactionModel())->updateTransaction($id, $_PUT);
                    $response  = ($result) ? ['status' => 'success', 'code' => 200] : ['status' => 'error', 'code' => 406];
                } else $response = ['status' => 'error', 'code' => 401];
                header('Content-Type: Application/json');
                echo json_encode($response);
                break;
            default:
                break;
        }
        break;
    case 'DELETE':
        switch ($component) {
            case 'users':
                $users = (new UserModel())->deleteUser(['id' => $id]);
                $response = ($users) ? ['code' => 201, 'status' => 'success'] : ['code' => 400, 'status' => 'error'];
                header('Content-Type: Application/json');
                echo json_encode($response);
                die;
            case 'cars':
                $cars = (new CarModel())->deleteCar(['id' => $id]);
                header('Content-Type: Application/json');
                echo json_encode($cars);
                die;
            case 'transactions':
                $transactions = (new TransactionModel())->deleteTransaction(['id' => $id]);
                header('Content-Type: Application/json');
                echo json_encode($transactions);
                die;
            default:
                die;
        }
        break;
}

function extractId($string)
{
    $numbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
    $str = str_split($string);
    for ($i = 0; $i < strlen($string) - 3; $i++) {
        if ($str[$i] === 'i' && $str[$i + 1] === 'd' && $str[$i + 2] === '=') {
            $int = '';
            for ($j = $i + 3; $j < strlen($string); $j++) {
                if (in_array((int)$str[$j], $numbers)) {
                    $int .= $str[$j];
                }
            }
            return (int)$int;
        }
    }
    return null;
}

function makeArray(array $array)
{
    $aux = [];
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            foreach ($value as $item) {
                $aux[] = urldecode($item);
            }
        }
    }
    return $aux;
}

function sanitizeData()
{
    $data = fopen('php://input', 'r');
    $parts = explode('=', fgets($data));
    $subParts = [];
    var_dump($parts);
    foreach ($parts as $part) {
        $subParts[] = explode('&', $part);
    }
    $rawData = makeArray($subParts);
    $result = [];
    for ( $i = 0; $i < count($rawData) - 1; $i+=2) {
        $result[$rawData[$i]] = $rawData[$i + 1];
    }
    return $result;
}

function filterGet()
{
    $aux = [];
    foreach ($_GET as $key => $item) {
        if ($key !== 'path') $aux[$key] = $item;
    }
    $_GET = $aux;
}