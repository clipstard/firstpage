<?php
/**
 * Created by PhpStorm.
 * User: eugeniu
 * Date: 3/27/19
 * Time: 9:19 PM
 */

require_once 'AbstractView.php';
class AboutView extends AbstractView {

    public function show() {
        require 'templates/index.html';
        return null;
    }
}