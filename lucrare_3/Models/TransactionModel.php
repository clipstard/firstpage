<?php
/**
 * Created by PhpStorm.
 * User: eugeniu
 * Date: 3/29/19
 * Time: 7:04 PM
 */

require_once 'AbstractModel.php';

class TransactionModel extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function executeQuery()
    {
        $query = $this->composeQuery();
        $stmt = self::$mysql->query($query);
        $transactions = [];

        if (!$stmt) return [false];
        while ($item = $stmt->fetch_assoc()) {
            $user = new User();
            $user->setId($item['user_id'])
                ->setName($item['user_name'])
                ->setTara($item['user_tara'])
                ->setEmail($item['user_tara'])
                ->setFirm($item['user_firma']);
            $car = new Car();
            $car->setId($item['car_id'])
                ->setTara($item['car_tara'])
                ->setPret($item['car_pret'])
                ->setVolume($item['car_volume'])
                ->setAnProducere($item['car_an_producere'])
                ->setParcurs($item['car_parcurs'])
                ->setMark($item['car_mark']);
            $transactions[] = (new Transaction())
                ->setId($item['id'])
                ->setUser($user)
                ->setCar($car)
                ->setData($item['data'])
                ->setClosed($item['closed']);
        }
        return $transactions;
    }

    /**
     * @return string
     */
    protected function composeQuery()
    {
        $query = "SELECT t.id, t.data, t.closed," .
            " u.id as user_id, u.name as user_name, u.firma as user_firma, u.email as user_email, u.tara as user_tara," .
            " c.id as car_id, c.mark as car_mark, c.an_producere as car_an_producere, c.volume as car_volume, c.parcurs as car_parcurs, c.tara as car_tara, c.pret as car_pret" .
            " from transaction t join user u on u.id = t.user_id join car c on c.id = t.car_id ";
        $nonUniqueFilter = false;
        $counts = 0;
        if (array_key_exists('order_by', $this->filters)) $counts++;
        if (array_key_exists('limit', $this->filters)) $counts++;
        if (count($this->filters) > $counts) {
            $query .= "where ";
            if (array_key_exists('id', $this->filters)) {
                $query .= "t.id = '" . $this->filters['id'] . "'";
            } else {
                if (array_key_exists('user_name', $this->filters)) {
                    $query .= 'u.name like "%' . $this->filters['user_name'] . '%"';
                    $nonUniqueFilter = true;
                }
                if (array_key_exists('car_mark', $this->filters)) {
                    $query .= 'c.mark like "%' . $this->filters['car_mark'] . '%"';
                    $nonUniqueFilter = true;
                }
                if (array_key_exists('data', $this->filters)) {
                    if ($nonUniqueFilter) $query .= ' and ';
                    $query .= 't.data like "%' . $this->filters['data'] . '%"';
                    $nonUniqueFilter = true;
                }

                if (array_key_exists('closed', $this->filters)) {
                    if ($nonUniqueFilter) $query .= ' and ';
                    $query .= 't.closed = "' . $this->filters['closed'] . '"';
                    $nonUniqueFilter = true;
                }
            }
        }
        $query .= " order by " . ($this->filters['order_by'] ? $this->filters['order_by'] : 't.id') . ' ' . ($this->filters['order_by_direction'] ? $this->filters['order_by_direction'] : 'asc');
        if (array_key_exists('limit', $this->filters)) {
            $query .= " limit " . $this->filters['limit'];
        }

        $query .= ';';
        return $query;
    }

    public function createEntity(array $data)
    {
        $transaction = new Transaction();
        $user = (new UserModel())->setFilters(['id' => $data['user_id']])->executeQuery()[0];
        if (!$user) echo json_encode(['status' => 'error', 'message' => 'User ' . $data['user_id'] . ' not found!', 'code' => 400]);
        $car = (new CarModel())->setFilters(['id' => $data['car_id']])->executeQuery()[0];
        if (!$car) echo json_encode(['status' => 'error', 'message' => 'Car ' . $data['car_id'] . ' not found!', 'code' => 400]);
        $transaction->setCar($car)
            ->setUser($user)
            ->setClosed(($data['closed'] === '0') ? 0 : 1)
            ->setData("" . date(DateConstant::$dateFormat, date_timestamp_get(new DateTime())));

        return $transaction;
    }

    public function flushTransaction(Transaction $transaction)
    {
        $query = "INSERT INTO transaction (user_id, car_id, data, closed) values(" . sprintf("'%s', '%s', '%s', '%s'", $transaction->getUser()->getId(), $transaction->getCar()->getId(), $transaction->getData(), $transaction->getClosed()) . ");";
        if (self::$mysql->query($query)) {
            return true;
        }
        return false;
    }

    public function updateTransactionSet(Transaction $transaction)
    {
        $query = "UPDATE transaction SET user_id = '" . $transaction->getUser()->getId() . "', car_id = '" . $transaction->getCar()->getId() . "', data = '" . date(DateConstant::$dateFormat, date_timestamp_get(new DateTime($transaction->getData()))) . "', closed = '" . $transaction->getClosed() . "' where id = '" . $transaction->getId() . "';";
        if (self::$mysql->query($query)) {
            return true;
        }
        return false;
    }

    public function updateTransaction(array $data)
    {
        $this->setFilters(['id' => $data['id']]);
        /** @var Transaction $transaction */
        $transaction = $this->executeQuery()[0];
        if (!$transaction) return false;
        $transaction->setClosed((int)$data['closed']);

        return $this->updateTransactionSet($transaction);
    }

    public function deleteTransaction(array $data)
    {
        $query = "DELETE FROM transaction where id = " . $data['id'];
        if (self::$mysql->query($query)) {
            return true;
        }
        return false;
    }
}