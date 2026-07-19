<?php

namespace Gladblog\Controllers;

use Gladblog\Route\Route;

class LoginController extends AbstractController
{
    #[Route('/login', name: "login", methods: ["GET"])]
    public function directLoginPage()
    {
        $message = '';
        if (($_GET['success'] ?? '') === 'account_deleted') {
            $message = 'Votre compte a bien été supprimé.';
        } elseif (($_GET['error'] ?? '') === 'auth_required') {
            $message = 'Veuillez vous connecter pour continuer.';
        }

        $this->render("login.php", [
            'message' => $message,
        ], "login", ["/public/css/login.css"]);
    }

    #[Route('/profile', name: "profile", methods: ["GET"])]
    public function directProfilePage()
    {
        $this->requireAuth();

        $user = $this->users()->getByUsername((string) $this->session()->username());

        $this->render("users/profile.php", [
            "message" => "",
            "userData" => $user?->getUsername(),
            "status" => $user?->getStatus(),
            "data" => $_GET
        ], "profile");
    }

    #[Route('/login', name: "login", methods: ["POST"])]
    public function login()
    {
        $formUsername = $_POST['username'] ?? '';
        $formPwd = $_POST['password'] ?? '';
        $user = $this->users()->getByUsername($formUsername);

        if (!$user) {
            $this->render("login.php", [
                "message" => "Vous n'êtes pas enregistré chez nous.",
                "data" => $_POST
            ], "Utilisateur Inconnu", ["/public/css/login.css"]);
            return;
        }

        if ($user->passwordMatch($formPwd)) {
            if (!$this->session()->isLoggedIn()) {
                $this->session()->login($user);
                $message = 'Bonjour ' . $this->session()->username() . ', vous êtes bien connecté.';
            } else {
                $message = 'Bonjour ' . $this->session()->username() . '. Vous êtes toujours connecté.';
            }

            $this->render("users/profile.php", [
                "message" => $message,
                "userData" => $user->getUsername(),
                "status" => $user->getStatus(),
                "data" => $_POST
            ], "profile");
            return;
        }

        $this->render("login.php", [
            "message" => 'mot de passe invalide',
            "data" => $_POST
        ], "Mot de passe invalide", ["/public/css/login.css"], ["/public/js/fade.js"]);
    }

    #[Route('/deconnect', name: "deconnexion", methods: ["GET"])]
    public function deconnect()
    {
        $this->session()->destroy();
        $this->render(
            "login.php",
            ["message" => 'Vous avez été déconnecté'],
            "login",
            ["/public/css/login.css"],
            ["/public/js/fade.js"]
        );
    }
}
