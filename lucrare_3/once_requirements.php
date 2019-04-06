<?php
/**
 * Created by PhpStorm.
 * User: eugeniu
 * Date: 3/29/19
 * Time: 6:09 PM
 */


// <!-- Controllers --> //
require_once 'Controllers/MainController.php';
require_once 'Controllers/ShowController.php';


// <!-- Views --> //

require_once 'Views/IndexView.php';
require_once 'Views/NotFoundView.php';
require_once 'Views/AboutView.php';
require_once 'Views/UserView.php';


// <!-- Models --> //
//require_once 'Models/Database.php';
require_once 'Models/UserModel.php';

require_once 'Entity/User.php';


// <!-- Migrations --> //
require_once 'Migrations/UserMigration.php';

