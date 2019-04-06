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
        echo $this->getUsersTable($userModel->executeQuery());
        return null;
    }

    /**
     * @param User[]|array $users
     * @return string
     */
    public function getUsersTable(array $users)
    {

        $result = '<table class="table">' .
            ' <thead class="thead-light">' .
            '<tr>'.
            '<th scope="col">Id</th>'.
            '<th scope="col">Nume</th>'.
            '<th scope="col">Email</th>'.
            '<th scope="col">Firma</th>'.
            '<th scope="col">Tara</th>'.
            '</tr>'.
            '</thead>';
        if(!count($users)) return $result;
        $result .= '<tbody>';
        foreach ($users as $user) {
            $result .=
                '<tr>' .
                '<th scope="row">'. $user->getId() . '</th>' .
                '<td>'. $user->getName() . '</td>' .
                '<td>'. $user->getEmail() . '</td>' .
                '<td>'. $user->getFirm() . '</td>' .
                '<td>'. $user->getTara() . '</td>' .
                '</tr>';
        }
        $result .= '</tbody>';
        return $result;
    }
}