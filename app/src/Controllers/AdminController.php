<?php
namespace Gladblog\Controllers;

use Gladblog\Factory\PDOFactory;
use Gladblog\Manager\UserManager;
use Gladblog\Route\Route;

class AdminController extends AbstractController
{
    #[Route('/backoffice', name: "deleteUser", methods: ["GET"])]
    public function accessBackoffice() {
        $styleLinks = ['/public/css/style.css',
            '/public/css/base.css',
            '/public/lib/materialize/css/materialize.css',
            'https://fonts.googleapis.com/icon?family=Material+Icons'
        ];
        $scripts = ['/public/lib/materialize/js/materialize.js'];

        $this->render("admin/backoffice.php", [
            "message" => '',
        ], "backoffice", $styleLinks, $scripts);
    }

    #[Route('/deleteUser', name: "deleteUser", methods: ["POST"])]
    public function deleteUser()
    {

        $formUserName = $_POST['username'];
        $formUserId = intval($_POST['userId']);
        $userManager = new UserManager(new PDOFactory());
        $user = $userManager->getByUsername($formUserName);

        if($user) {

            $userManager->deleteUser($formUserId, $formUserName);

            $styleLinks = ['/public/css/style.css',
                '/public/css/base.css',
                '/public/lib/materialize/css/materialize.css',
                'https://fonts.googleapis.com/icon?family=Material+Icons'
            ];
            $scripts = ['/public/lib/materialize/js/materialize.js'];

            $this->render("admin/backoffice.php", [
                "message" => $formUserName.'a été supprimé de la base',
            ], "backoffice", $styleLinks, $scripts);
        } else {
            header('Location: \?error=nousertodelete');
        }

    }
}