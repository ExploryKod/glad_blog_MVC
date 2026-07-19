<?php

namespace Gladblog\Controllers;

use Gladblog\Route\Route;

class AdminController extends AbstractController
{
    #[Route('/upgrade', name: "upgrade", methods: ["GET"])]
    public function becomeAdmin()
    {
        $this->render("admin/admin_test.php", [], "backoffice");
    }

    #[Route('/register_admin', name: "exam", methods: ["POST"])]
    public function examAdmin()
    {
        $userId = $this->session()->userId() ?? 0;
        $answer = htmlspecialchars($_POST['answer'] ?? '');

        if ($userId <= 0) {
            $this->render("login.php", [], "login", ["/public/css/login.css"]);
            return;
        }

        if ($answer !== 'blanc') {
            $this->render("users/profile.php", [
                'message' => 'Vous n\' avez pas su répondre, vous n\' êtes pas admis',
                'tailwind' => [false, '/public/js/tailwind.js']
            ], "backoffice");
            return;
        }

        $user = $this->users()->getByUserid((string) $userId);
        if ($user) {
            $this->users()->setAdminRights($user);
            $this->session()->set('userStatus', $user->getStatus());
        }

        $this->render("admin/backoffice.php", [
            'message' => 'Bienvenue dans le cercle des administrateurs',
            'userInfos' => $this->users()->getAllUsers(),
            'your_id' => $userId,
            'tailwind' => [false, '/public/js/tailwind.js']
        ], "backoffice");
    }

    #[Route('/backoffice', name: "backOffice", methods: ["GET"])]
    public function accessBackoffice()
    {
        $this->render("admin/backoffice.php", [
            "message" => '',
            "userInfos" => $this->users()->getAllUsers(),
            'your_id' => $this->session()->userId(),
            'tailwind' => [true, '/public/js/tailwind.js']
        ], "backoffice");
    }

    #[Route('/deleteUser', name: "deleteUser", methods: ["POST"])]
    public function deleteUser()
    {
        $formUserName = $_POST['username'] ?? '';
        $formUserId = intval($_POST['userId'] ?? 0);
        $user = $this->users()->getByUsername($formUserName);

        if (!$user) {
            $this->redirect('/?error=nousertodelete');
        }

        $this->users()->deleteUser($formUserId, $formUserName);

        $this->render("admin/backoffice.php", [
            "message" => $formUserName . ' a été supprimé de la base',
            'userInfos' => $this->users()->getAllUsers(),
            'your_id' => $this->session()->userId(),
            'tailwind' => [false, '/public/js/tailwind.js']
        ], "backoffice");
    }

    #[Route('/updateUser', name: "updateUser", methods: ["POST"])]
    public function updateUser()
    {
        if (!isset($_POST['update-user'])) {
            $this->redirect('/?error=nopostmethod');
        }

        $UserName = filter_input(INPUT_POST, "username-checked");
        $formUserId = intval($_POST['userId'] ?? 0);
        $user = $this->users()->getByUsername((string) $UserName);

        if (!$user) {
            $this->redirect('/?error=nousertoupdate');
        }

        $user->setId($formUserId);
        $user->applyUpdates([
            'first_name' => filter_input(INPUT_POST, "first_name") ?: null,
            'last_name' => filter_input(INPUT_POST, "last_name") ?: null,
            'email' => filter_input(INPUT_POST, "email") ?: null,
            'birth_date' => filter_input(INPUT_POST, "birth_date") ?: null,
            'password' => filter_input(INPUT_POST, "password") ?: null,
            'username' => filter_input(INPUT_POST, "username") ?: null,
            'status' => filter_input(INPUT_POST, "status") ?: null,
        ]);
        $this->users()->updateUser($user);

        $this->render("admin/backoffice.php", [
            "message" => $UserName . ' a été modifié dans la base',
            "your_id" => $this->session()->userId(),
            "userInfos" => $this->users()->getAllUsers(),
        ], "backoffice");
    }
}
