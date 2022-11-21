<?php

namespace Gladblog\Controllers;

use Gladblog\Factory\PDOFactory;
use Gladblog\Manager\UserManager;
use Gladblog\Route\Route;

class SecurityController extends AbstractController
{
    #[Route('/login', name: "login", methods: ["GET"])]
    public function directLoginPage()
    {
        $links = ['/public/css/style.css',
            '/public/css/base.css',
            '/public/lib/materialize/css/materialize.css',
            'https://fonts.googleapis.com/icon?family=Material+Icons'
        ];
        $scripts = ['/public/lib/materialize/js/materialize.js'];
        $this->render("login.php", [], "Login page", $links, $scripts);
    }

    #[Route('/login', name: "login", methods: ["POST"])]
    public function login()
    {
        $formUsername = $_POST['username'] ?? "toto";
        $formPwd = $_POST['password'] ?? "toto";

        $userManager = new UserManager(new PDOFactory());
        $user = $userManager->getByUsername($formUsername);

        if (!$user) {
            header("Location: /?error=no-user");
            exit;
        }

            $links = ['/public/css/style.css',
                '/public/css/base.css',
                '/public/lib/materialize/css/materialize.css',
                'https://fonts.googleapis.com/icon?family=Material+Icons'
            ];
            $scripts = ['/public/lib/materialize/js/materialize.js'];

            $this->render("users/showUsers.php", [
                "message" => "je suis un message",
                "data" => $userManager->getByUsername($formUsername),
                "hash" => $userManager->getByUsername($formUsername)->getHashedPassword()

            ],
                "logged space", $links, $scripts);


        //header("Location: /?error=notfound");
        //exit;
    }
}