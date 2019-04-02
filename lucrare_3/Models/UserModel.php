<?php
/**
 * Created by PhpStorm.
 * User: eugeniu
 * Date: 3/29/19
 * Time: 7:04 PM
 */

require_once 'AbstractModel.php';
class UserModel extends AbstractModel {

    public function __construct()
    {
        parent::__construct();
    }

    public function executeQuery()
    {
        $query = "select * from user";
        $stmt = self::$mysql->query($query);
        $users = [];

        while ($item = $stmt->fetch_assoc()) {
            $users[] = (new User)
                ->setId($item['id'])
                ->setName($item['name'])
                ->setFirm($item['firm'])
                ->setTara($item['tara'])
                ->setEmail($item['email'])
            ;
        }
        return $users;
    }


    protected function composeQuery()
    {
        foreach ($this->filters as $key => $filter) {
            if (is_int($key)) {
                switch (true) {
                    case strtolower($filter) === 'limit':
                }
            }
        }
    }

}