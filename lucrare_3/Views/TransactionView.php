<?php
require_once 'AbstractView.php';

/**
 * Class CarView
 */
class TransactionView extends AbstractView
{
    public function show()
    {
        $transactionModel = new TransactionModel();
        $this->getTransactionsTemplate();
        return null;
    }

    /**
     * @param User[]|array $users
     * @return string
     */
    public function getTransactionsTable(array $users)
    {
        return json_encode($users);
    }

    public function getTransactionsTemplate()
    {
        echo "<p id='transactionsTable' style='width:100%;'></p>";
        echo "<script src='../assets/js/transactionsTable.js'></script>";
    }
}