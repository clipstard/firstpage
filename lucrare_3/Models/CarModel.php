<?php
/**
 * Created by PhpStorm.
 * User: eugeniu
 * Date: 3/29/19
 * Time: 7:04 PM
 */

require_once 'AbstractModel.php';

class CarModel extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function executeQuery()
    {
        $query = $this->composeQuery();
        $stmt = self::$mysql->query($query);
        $cars = [];

        while ($item = $stmt->fetch_assoc()) {
            $cars[] = (new Car)
                ->setId($item['id'])
                ->setTara($item['tara'])
                ->setAnProducere($item['an_producere'])
                ->setMark($item['mark'])
                ->setParcurs($item['parcurs'])
                ->setVolume($item['volume'])
                ->setPret($item['pret']);
        }
        return $cars;
    }

    /**
     * @return string
     */
    protected function composeQuery()
    {
        $query = "SELECT * from car ";
        $nonUniqueFilter = false;
        $counts = 0;
        if (array_key_exists('order_by', $this->filters)) $counts++;
        if (array_key_exists('limit', $this->filters)) $counts++;
        if (count($this->filters) > $counts) {
            $query .= "where ";
            if (array_key_exists('id', $this->filters)) {
                $query .= "id = '" . $this->filters['id'] . "'";
            } else {
                if (array_key_exists('mark', $this->filters)) {
                    $query .= 'mark like "%' . $this->filters['mark'] . '%"';
                    $nonUniqueFilter = true;
                }
                if (array_key_exists('an_producere', $this->filters)) {
                    $query .= 'an_producere like "%' . $this->filters['an_producere'] . '%"';
                    $nonUniqueFilter = true;
                }
                if (array_key_exists('parcurs', $this->filters)) {
                    if ($nonUniqueFilter) $query .= ' and ';
                    $query .= 'parcurs like "%' . $this->filters['parcurs'] . '%"';
                    $nonUniqueFilter = true;
                }

                if (array_key_exists('tara', $this->filters)) {
                    if ($nonUniqueFilter) $query .= ' and ';
                    $query .= 'tara like "%' . $this->filters['tara'] . '%"';
                    $nonUniqueFilter = true;
                }

                if (array_key_exists('volume', $this->filters)) {
                    if ($nonUniqueFilter) $query .= ' and ';
                    $query .= 'volume like "%' . $this->filters['volume'] . '%"';
                    $nonUniqueFilter = true;
                }

                if (array_key_exists('pret', $this->filters)) {
                    if ($nonUniqueFilter) $query .= ' and ';
                    $query .= 'pret like "%' . $this->filters['pret'] . '%"';
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
        $car = new Car();
        $car->setVolume($data['volume'])
            ->setParcurs($data['parcurs'])
            ->setMark($data['mark'])
            ->setAnProducere($data['an_producere'])
            ->setTara($data['tara'])
            ->setPret($data['pret']);

        return $car;
    }

    public function flushCar(Car $car)
    {
        $query = "INSERT INTO car(mark, an_producere, parcurs, volume, tara, pret) values(" . sprintf("'%s', '%s', '%s', '%s', '%s', '%s'", $car->getMark(), $car->getAnProducere(), $car->getParcurs(), $car->getVolume(), $car->getTara(), $car->getPret()) . ");";
        if (self::$mysql->query($query)) {
            return true;
        }
        return false;
    }

    public function updateCarSet(Car $car)
    {
        $query = "UPDATE car SET mark = '" . $car->getMark() . "', an_producere = '" . $car->getAnProducere() . "', parcurs = '" . $car->getParcurs() . "', volume = '" . $car->getVolume() . "', tara = '" . $car->getTara() . "', pret = '" . $car->getPret() ."' where id = " . $car->getId() . ";";
        if (self::$mysql->query($query)) {
            return true;
        }
        return false;
    }

    public function updateCar($id, array $data)
    {
        $this->setFilters(['id' => $id]);
        /** @var Car $car */
        $car = $this->executeQuery()[0];
        if (!$car) return false;
        $car->setTara($data['tara'])
            ->setAnProducere($data['an_producere'])
            ->setMark($data['mark'])
            ->setParcurs($data['parcurs'])
            ->setVolume($data['volume'])
            ->setPret($data['pret']);
        return $this->updateCarSet($car);
    }

    public function deleteCar(array $data)
    {
        $query = "DELETE FROM car where id = " . $data['id'];
        if (self::$mysql->query($query)) {
            return true;
        }
        return false;
    }
}
/* TODO
   CITEVA liste top5 / top10 + buttons export csv/xlm
1 -> lista de companii cu nr de success tests
(filtru cu dropdown cu lista de companii -> subcompanii -> external companii)
2 -> lista de useri cu nr de success tests/trainings
 */