<?php

namespace Gladblog\Controllers;
use Gladblog\Entity\User;
use Gladblog\Exception\DomainException;
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
            $first_name = htmlspecialchars($_POST['first_name']);
            $last_name = htmlspecialchars($_POST['last_name']);
            $birth_date = htmlspecialchars($_POST['birth_date']);
            $email = htmlspecialchars($_POST['email']);
            $userManager = new UserManager(new PDOFactory());
            $existing = $userManager->getByUsername($username);

            if (!$existing) {
                try {
                    $user = User::register($username, $password, $first_name, $last_name, $birth_date, $email);
                    $userManager->insertUser($user);
                } catch (DomainException $e) {
                    header("Location: /?error=" . urlencode($e->getMessage()));
                    exit;
                }

                $links = ['/public/css/login.css'];
                $scripts = [];
                $this->render("login.php", [
                    'data' => $_POST
                ], "register", $links, $scripts);

            } else {
                header("Location: /?error=alreadyRegistered");
                exit;
            }
        } else {
            header("Location: /?error=notFilled");
            exit;
        }
    }
}
