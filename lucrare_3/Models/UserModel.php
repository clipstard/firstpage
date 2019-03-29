<?php
/**
 * Created by PhpStorm.
 * User: eugeniu
 * Date: 3/29/19
 * Time: 7:04 PM
 */
require_once 'AbstractModel.php';
class UserModel extends AbstractModel {

    public function executeQuery()
    {
        $query = "select * from user";
        $stmt = self::$mysql->query($query);
        $users = [];
        $result = mysqli_fetch_all($stmt);
        foreach ($result as $item){
            $users[] = (new User)->setId($item[0])->setName($item[1]);
        }
        return $users;
    }
}

