<?php
namespace Gladblog\Controllers;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
        $userManager = new UserManager(new PDOFactory());
        $formUsername = $_SESSION['user'];
        $links = [];
        $scripts = [];
        $message = "";
        $this->render("users/profile.php", [
            "message" => $message,
            "userData" => $userManager->getByUsername($formUsername)->getUsername(),
            "status" => $userManager->getByUsername($formUsername)->getStatus(),
            "data" => $_GET
        ],
            "profile", $links, $scripts);
    }

    #[Route('/login', name: "login", methods: ["POST"])]
    public function login()
    {

        $formUsername = $_POST['username'];
        $formPwd = $_POST['password'];
        $userManager = new UserManager(new PDOFactory());
        $user = $userManager->getByUsername($formUsername);
        $userId = $userManager->getByUsername($formUsername)->getId();
        $userStatus = $userManager->getByUsername($formUsername)->getStatus();
        $links = [];
        $scripts = [];

        if (!$user) {
            $message = "Vous n'êtes pas enregistré chez nous.";
            $links = ["/public/css/login.css"];
            $this->render("login.php", [
                "message" => $message,
                "userData" => $userManager->getByUsername($formUsername)->getUsername(),
                "status" => $userManager->getByUsername($formUsername)->getStatus(),
                "hash" => $userManager->getByUsername($formUsername)->getHashedPassword(),
                "data" => $_POST
            ],
                "Utilisateur Inconnu", $links, $scripts);
        }

        if ($user->passwordMatch($formPwd))  {

            if(empty($_SESSION['userId'])) {
                $_SESSION['user'] = $formUsername;
                $_SESSION['userId'] = $userId;
                $_SESSION['userStatus'] = $userStatus;
                $message = 'Bonjour '.$_SESSION['user'].', vous êtes bien connecté.';
            } else {
                $message = 'Bonjour '.$_SESSION['user'].'. Vous êtes toujours connecté.';
            }

            $this->render("users/profile.php", [
                "message" => $message,
                "userData" => $userManager->getByUsername($formUsername)->getUsername(),
                "status" => $userManager->getByUsername($formUsername)->getStatus(),
                "data" => $_POST
            ],
                "profile", $links, $scripts);

        } else {
            $message = 'mot de passe invalide';
            $links = ["/public/css/login.css"];
            $scripts = ["/public/js/fade.js"];
            $this->render("login.php", [
                "message" => $message,
                "data" => $_POST
            ],
                "Mot de passe invalide", $links, $scripts);
        }

        header('Location: /?error="unknown"');
        exit();
    }

    #[Route('/deconnect', name: "deconnexion", methods: ["GET"])]
    public function deconnect()
    {
        // Détruire la session.
        if (session_destroy()) {
            // Redirection vers la page de connexion
            $links = ["/public/css/login.css"];
            $scripts = ["/public/js/fade.js"];
            $this->render("login.php", ["message" => 'Vous avez été déconnecté'], "login", $links, $scripts);
            exit();
        }

    }

}