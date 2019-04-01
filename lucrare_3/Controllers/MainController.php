<?php
/**
 * Created by PhpStorm.
 * User: eugeniu
 * Date: 3/29/19
 * Time: 5:28 PM
 */

require_once 'AbstractController.php';
/**
 * Class MainController
 */
class MainController extends AbstractController {

    /**
     * MainController constructor.
     * @param $route
     */
    public function __construct($route = null)
    {
        parent::__construct($route);
    }

    public function execute()
    {

        switch ($this->route){
            case '':
            case '/':
                (new IndexView())->show();
                $results = (new UserModel())->executeQuery();

            /** @var User $user */
            foreach ($results as $user) {
                    echo $user->getId() .
                        " " . $user->getName() .
                        " " . $user->getEmail() .
                        " " . $user->getFirm() .
                        " " . $user->getTara() .
                        "<br />";

            }
                break;
            case '/about':
                (new AboutView())->show();
                break;
            case '/createUser':
                var_dump($_POST);

                break;
            default:
                (new NotFoundView())->show();
                break;
        }
    }
}