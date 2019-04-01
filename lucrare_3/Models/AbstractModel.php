<?php
/**
 * Created by PhpStorm.
 * User: eugeniu
 * Date: 3/27/19
 * Time: 9:19 PM
 */


abstract class AbstractModel {
    public static $mysql;
    public function __construct()
    {
        self::$mysql = new mysqli('localhost', 'user', '', 'admin');
    }

    public abstract function executeQuery();
}