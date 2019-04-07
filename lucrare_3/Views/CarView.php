<?php
require_once 'AbstractView.php';

/**
 * Class CarView
 */
class CarView extends AbstractView
{
    public function show()
    {
        $carModel = new CarModel();
        $this->getCarsTemplate();
        return null;
    }

    /**
     * @param User[]|array $users
     * @return string
     */
    public function getCarsTable(array $users)
    {
        return json_encode($users);
    }

    public function getCarsTemplate()
    {
        echo "<p id='carsTable' style='width:100%;'></p>";
        echo "<script src='../assets/js/carsTable.js'></script>";
    }
}