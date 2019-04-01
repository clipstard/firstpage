<?php
/**
 * Created by PhpStorm.
 * User: eugeniu
 * Date: 3/27/19
 * Time: 9:19 PM
 */

class NotFoundView extends AbstractView {

    public function show() {
        require 'templates/404.html';
        return null;
    }
}