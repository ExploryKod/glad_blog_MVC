<?php

namespace Gladblog\Controllers;

use Gladblog\Entity\User;
use Gladblog\Exception\DomainException;
use Gladblog\Route\Route;

class RegisterController extends AbstractController
{
    #[Route('/register', name: "register", methods: ["POST"])]
    public function register()
    {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            $this->redirect('/?error=notFilled');
        }

        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $first_name = htmlspecialchars($_POST['first_name'] ?? '');
        $last_name = htmlspecialchars($_POST['last_name'] ?? '');
        $birth_date = htmlspecialchars($_POST['birth_date'] ?? '');
        $email = htmlspecialchars($_POST['email'] ?? '');

        if ($this->users()->getByUsername($username)) {
            $this->redirect('/?error=alreadyRegistered');
        }

        try {
            $user = User::register($username, $password, $first_name, $last_name, $birth_date, $email);
            $this->users()->insertUser($user);
        } catch (DomainException $e) {
            $this->redirect('/?error=' . urlencode($e->getMessage()));
        }

        $this->render("login.php", [
            'data' => $_POST
        ], "register", ['/public/css/login.css']);
    }
}
