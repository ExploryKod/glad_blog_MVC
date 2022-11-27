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
        $links = ["/public/css/login.css"];
        $scripts = [];
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
        $userId = $userManager->getByUsername($formUsername)->getId();
        $_SESSION['userId'] = $userId;

        if (!$user) {
            header("Location: /?error=no-user");
            exit;
        }

        if ($user->passwordMatch($formPwd))  {
            $links = [];
            $scripts = [];

            $this->render("users/profile.php", [
                "message" => "hash est vérifié",
                "userData" => $userManager->getByUsername($formUsername)->getUsername(),
                "status" => $userManager->getByUsername($formUsername)->getStatus(),
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
        // Détruire la session.
        if (session_destroy()) {
            // Redirection vers la page de connexion
            $links = ["/public/css/login.css"];
            $scripts = [];
            $this->render("login.php", [], "login", $links, $scripts);
            exit();
        }

    }

}