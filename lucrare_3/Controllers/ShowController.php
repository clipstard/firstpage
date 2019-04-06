<?php
/**
 * Created by PhpStorm.
 * User: eugeniu
 * Date: 3/29/19
 * Time: 5:28 PM
 */

require_once 'AbstractController.php';

/**
 * Class ShowController
 */
class ShowController extends AbstractController
{

    /**
     * ShowController constructor.
     * @param $route
     */
    public function __construct($route = null)
    {
        parent::__construct($route);
    }

    public function execute()
    {
        switch ($_SERVER['argv'][0]) {
            case 'users':
            (new UserView())->show();
                break;
            case '/about':
                (new AboutView())->show();
                break;
            default:
                (new NotFoundView())->show();
                break;
        }
    }
}