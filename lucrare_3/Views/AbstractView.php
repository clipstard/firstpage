<?php
/**
 * Created by PhpStorm.
 * User: eugeniu
 * Date: 3/29/19
 * Time: 5:41 PM
 */

abstract class AbstractView
{
    abstract public function show();

    protected function getTableHeader()
    {
    }
}