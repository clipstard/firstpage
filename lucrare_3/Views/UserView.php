<?php
require_once 'AbstractView.php';


/**
 * Class UserView
 */
class UserView extends AbstractView
{
    public function show()
    {
        $userModel = new UserModel();
        echo $this->getUsersTemplate();
        return null;
    }

    /**
     * @param User[]|array $users
     * @return string
     */
    public function getUsersTable(array $users)
    {
        return json_encode($users);
    }

    public function getUsersTemplate()
    {
        echo "<div id='usersTable' style='width:100%;'></div>";
        echo "<script src='../assets/js/userTable.js'></script>";
    }
}