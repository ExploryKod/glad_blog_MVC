<?php

namespace Gladblog\Controllers;
use Gladblog\Entity\User;
use Gladblog\Factory\PDOFactory;
use Gladblog\Manager\UserManager;
use Gladblog\Route\Route;

class RegisterController extends AbstractController
{
    #[Route('/register', name: "register", methods: ["POST"])]
    public function register()
    {
        if(!empty($_POST['username']) && !empty($_POST['password']))
        {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $userManager = new UserManager(new PDOFactory());
            $user = $userManager->getByUsername($username);

            if (!$user) {

             // Si l'utilisateur n'est pas déjà dans la base car getByUserName rend null donc il rend false
                $userManager->insertUser($password, $username);
                $links = ['/public/css/style.css',
                    '/public/css/base.css',
                    '/public/lib/materialize/css/materialize.css',
                    'https://fonts.googleapis.com/icon?family=Material+Icons'
                ];
                $scripts = ['/public/lib/materialize/js/materialize.js'];
                $this->render("users/profile.php", [
                    'data' => $_POST
                ], "Votre profile", $links, $scripts);

            } else {
                // getByUserName est true (rend une valeur) donc ...
                header("Location: /?error=alreadyRegistered");
                exit;
            }
        } else {
            //if is not filled
            header("Location: /?error=notFilled");
            exit;
        }
    }
}
