<?php
namespace Gladblog\Controllers;
session_start();
use Gladblog\Factory\PDOFactory;
use Gladblog\Manager\UserManager;
use Gladblog\Route\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: "login", methods: ["GET"])]
    public function directLoginPage()
    {
        $links = ['/public/css/style.css',
            '/public/css/base.css',
            '/public/lib/materialize/css/materialize.css',
            'https://fonts.googleapis.com/icon?family=Material+Icons'
        ];
        $scripts = ['/public/lib/materialize/js/materialize.js',   '/public/js/script.js'];
        $this->render("login.php", [], "login", $links, $scripts);
    }

    #[Route('/profile', name: "profile", methods: ["GET"])]
    public function directProfilePage()
    {
        $this->redirect("profile.php");
    }

    #[Route('/login', name: "login", methods: ["POST"])]
    public function login()
    {
        $formUsername = $_POST['username'];
        $formPwd = $_POST['password'];
        $_SESSION['user'] = $formUsername;

        $userManager = new UserManager(new PDOFactory());
        $user = $userManager->getByUsername($formUsername);

        if (!$user) {
            header("Location: /?error=no-user");
            exit;
        }

        if ($user->passwordMatch($formPwd))  {
            $links = ['/public/css/style.css',
                '/public/css/base.css',
                '/public/lib/materialize/css/materialize.css',
                'https://fonts.googleapis.com/icon?family=Material+Icons'
            ];
            $scripts = ['/public/lib/materialize/js/materialize.js',  '/public/js/script.js'];

            $this->render("users/profile.php", [
                "message" => "hash est vérifié",
                "userData" => $userManager->getByUsername($formUsername),
                "hash" => $userManager->getByUsername($formUsername)->getHashedPassword(),
                "data" => $_POST
            ],
                "profile", $links, $scripts);

        } else {
            header("Location: /?error=password-no-ok");
            exit;
        }

        header("Location: /?error=notfound");
        exit;
    }

    #[Route('/deconnect', name: "deconnexion", methods: ["GET"])]
    public function deconnect()
    {
        $this->redirect('deconnexion.php');
        exit();
    }

}