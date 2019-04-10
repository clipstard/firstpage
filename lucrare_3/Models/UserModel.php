<?php
/**
 * Created by PhpStorm.
 * User: eugeniu
 * Date: 3/29/19
 * Time: 7:04 PM
 */

require_once 'AbstractModel.php';

class UserModel extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function executeQuery()
    {
        $query = $this->composeQuery();
        $stmt = self::$mysql->query($query);
        $users = [];

        while ($item = $stmt->fetch_assoc()) {
            $users[] = (new User)
                ->setId($item['id'])
                ->setName($item['name'])
                ->setFirm($item['firma'])
                ->setTara($item['tara'])
                ->setEmail($item['email']);
        }
        return $users;
    }

    /**
     * @return string
     */
    protected function composeQuery()
    {
        $query = "SELECT * from user ";
        $nonUniqueFilter = false;
        $counts = 0;
        if (array_key_exists('order_by', $this->filters)) $counts++;
        if (array_key_exists('limit', $this->filters)) $counts++;
        if (count($this->filters) > $counts) {
            $query .= "where ";
            if (array_key_exists('id', $this->filters)) {
                $query .= "id = '" . $this->filters['id'] . "'";
            } else {
                if (array_key_exists('name', $this->filters)) {
                    $query .= 'name like "%' . $this->filters['name'] . '%"';
                    $nonUniqueFilter = true;
                }
                if (array_key_exists('email', $this->filters)) {
                    $query .= 'email like "%' . $this->filters['email'] . '%"';
                    $nonUniqueFilter = true;
                }
                if (array_key_exists('firm', $this->filters)) {
                    if ($nonUniqueFilter) $query .= ' and ';
                    $query .= 'firm like "%' . $this->filters['firm'] . '%"';
                    $nonUniqueFilter = true;
                }

                if (array_key_exists('tara', $this->filters)) {
                    if ($nonUniqueFilter) $query .= ' and ';
                    $query .= 'tara like "%' . $this->filters['tara'] . '%"';
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
        $user = new User();
        $user->setEmail($data['email'])
            ->setName($data['name'])
            ->setFirm($data['firma'])
            ->setTara($data['tara']);

        return $user;
    }

    public function flushUser(User $user)
    {
        $query = "INSERT INTO user(name, email, firma, tara) values(" . sprintf("'%s', '%s', '%s', '%s'", $user->getName(), $user->getEmail(), $user->getFirm(), $user->getTara()) . ");";
        if (self::$mysql->query($query)) {
            return true;
        }
        return false;
    }

    public function updateUserSet(User $user)
    {
        $query = "UPDATE user SET name = '" . $user->getName() . "', email = '" . $user->getEmail() . "', firma = '". $user->getFirm() . "', tara = '" . $user->getTara() . "' where id = " . $user->getId();
        if (self::$mysql->query($query)) {
            return true;
        }
        return false;
    }

    public function updateUser(array $data)
    {
        $this->setFilters(['id' => $data['id']]);
        /** @var User $user */
        $user = $this->executeQuery()[0];
        if (!$user) return false;
        $user->setName($data['name'])
            ->setTara($data['tara'])
            ->setFirm($data['firma'])
            ->setEmail($data['email'])
            ;
        return $this->updateUserSet($user);
    }

    public function deleteUser(array $data)
    {
        $query = "DELETE FROM user where id = " . $data['id'];
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