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

        while ($item = $stmt->fetch_assoc()) {
            $transactions[] = (new Transaction())
                ->setId($item['id'])
                ->setUser($item['user_id'])
                ->setCar($item['car_id'])
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
        $query = "SELECT * from transaction ";
        $nonUniqueFilter = false;
        $counts = 0;
        if (array_key_exists('order_by', $this->filters)) $counts++;
        if (array_key_exists('limit', $this->filters)) $counts++;
        if (count($this->filters) > $counts) {
            $query .= "where ";
            if (array_key_exists('id', $this->filters)) {
                $query .= "id = " . $this->filters['id'];
            } else {
                if (array_key_exists('user_id', $this->filters)) {
                    $query .= 'user_id = "' . $this->filters['user_id'] . '"';
                    $nonUniqueFilter = true;
                }
                if (array_key_exists('car_id', $this->filters)) {
                    $query .= 'car_id = "' . $this->filters['car_id'] . '"';
                    $nonUniqueFilter = true;
                }
                if (array_key_exists('data', $this->filters)) {
                    if ($nonUniqueFilter) $query .= ' and ';
                    $query .= 'data like "%' . $this->filters['data'] . '%"';
                    $nonUniqueFilter = true;
                }

                if (array_key_exists('closed', $this->filters)) {
                    if ($nonUniqueFilter) $query .= ' and ';
                    $query .= 'closed = "' . $this->filters['closed'] . '"';
                    $nonUniqueFilter = true;
                }
            }
        }

        if (array_key_exists('order_by', $this->filters)) {
            $query .= " order by " . $this->filters['order_by'] . ' ' . ($this->filters['order_by_direction'] ? $this->filters['order_by_direction'] : 'asc');
        }
        if (array_key_exists('limit', $this->filters)) {
            $query .= " limit " . $this->filters['limit'];
        }

        $query .= ';';
        return $query;
    }

    public function createEntity(array $data)
    {
        $transaction = new Transaction();
        $transaction->setCar($data['car_id'])
            ->setUser($data['user_id'])
            ->setClosed($data['closed'])
            ->setData($data['data']);

        return $transaction;
    }

    public function flushTransaction(Transaction $transaction)
    {
        $query = "INSERT INTO transaction (user_id, car_id, data, closed) values(" . sprintf("'%s', '%s', '%s', '%s'", $transaction->getUser(), $transaction->getCar(), date(DateConstant::$dateFormat, date_timestamp_get(new DateTime($transaction->getData()))), $transaction->getClosed()) . ");";
        if (self::$mysql->query($query)) {
            return true;
        }
        return false;
    }

    public function updateTransactionSet(Transaction $transaction)
    {
        $query = "UPDATE transaction SET user_id = '" . $transaction->getUser() . "', car_id = '" . $transaction->getCar() . "', data = '" . date(DateConstant::$dateFormat, date_timestamp_get(new DateTime($transaction->getData()))) . "', closed = '" . "' where id = '" . $transaction->getId() . "';";
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
        $transaction->setData($data['data'])
            ->setClosed($data['closed'])
            ->setUser($data['user_id'])
            ->setCar($data['car_id']);
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