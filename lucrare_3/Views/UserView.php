<?php
require_once 'AbstractView.php';


/**
 * Class UserView
 */
class UserView extends AbstractView {

    public function show() {
        require 'templates/index.html';
        return null;
    }

    public function getUsersTable($params = array()) {

    }
}