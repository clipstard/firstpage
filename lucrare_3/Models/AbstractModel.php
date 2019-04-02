<?php
/**
 * Created by PhpStorm.
 * User: eugeniu
 * Date: 3/27/19
 * Time: 9:19 PM
 */


abstract class AbstractModel {
    public static $mysql;
    protected $filters;
    public function __construct()
    {
        self::$mysql = new mysqli('localhost', 'user', '', 'admin');
        $this->filters = array();
    }

    public abstract function executeQuery();

    /**
     * @return array
     */
    public function getFilters() {
        return $this->filters;
    }

    /**
     * @param $filters
     * @return $this
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
        return $this;
    }

    public function addFilters(array $filters)
    {
        foreach ($filters as $key => $filter) {
            if (!in_array($filter, $this->filters)) $this->filters[$key] = $filter;
        }
        return $this;
    }
}