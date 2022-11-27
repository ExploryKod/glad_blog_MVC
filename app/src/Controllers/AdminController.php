<?php
namespace Gladblog\Controllers;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
use Gladblog\Factory\PDOFactory;
use Gladblog\Manager\UserManager;
use Gladblog\Route\Route;

class AdminController extends AbstractController
{

    #[Route('/upgrade', name: "upgrade", methods: ["GET"])]
    public function becomeAdmin() {
        $styleLinks = [];
        $scripts = [];
        $this->render("admin/admin_test.php", [], "backoffice", $styleLinks, $scripts);

    }

    #[Route('/register_admin', name: "exam", methods: ["POST"])]
    public function examAdmin() {
        $styleLinks = [];
        $scripts = [];
        $userId = intval($_SESSION['userId']);
        $badge = 'admin';
        $answer = htmlspecialchars($_POST['answer']);
        if(isset($userId))  {
            if($answer === 'blanc') {
                $_SESSION['userStatus'] = 'admin';
                $userManager = new UserManager(new PDOFactory());
                $userManager->setAdminRights($userId, $badge);
                $users = $userManager->getAllUsers();
                $this->render("admin/backoffice.php", [
                    'message' => 'Bienvenue dans le cercle des administrateurs',
                    'userInfos' => $users,
                    'your_id' > $userId,
                    'tailwind' => [false, '/public/js/tailwind.js']
                ], "backoffice", $styleLinks, $scripts);
            } else {
                $this->render("users/profile.php", [
                    'message' => 'Vous n\' avez pas su répondre, vous n\' êtes pas admis',
                    'tailwind' => [false, '/public/js/tailwind.js']
                ], "backoffice", $styleLinks, $scripts);
            }
        } else {
            $links = ["/public/css/login.css"];
            $this->render("login.php", [], "login", $links, $scripts);
            exit();
        }
    }

    #[Route('/backoffice', name: "backOffice", methods: ["GET"])]
    public function accessBackoffice() {

        $userManager = new UserManager(new PDOFactory());
        $users = $userManager->getAllUsers();
        $userId = intval($_SESSION['userId']);
        $styleLinks = [];
        $scripts = [];
        $this->render("admin/backoffice.php", [
            "message" => '',
            "userInfos" => $users,
            'your_id' > $userId,
            'tailwind' => [true, '/public/js/tailwind.js']
        ], "backoffice", $styleLinks, $scripts);
    }

    #[Route('/deleteUser', name: "deleteUser", methods: ["POST"])]
    public function deleteUser()
    {

        $formUserName = $_POST['username'];
        $formUserId = intval($_POST['userId']);
        $userManager = new UserManager(new PDOFactory());
        $user = $userManager->getByUsername($formUserName);
        $users = $userManager->getAllUsers();

        if($user) {

            $userManager->deleteUser($formUserId, $formUserName);
            $userId = intval($_SESSION['userId']);
            $styleLinks = [];
            $scripts = [];

            $this->render("admin/backoffice.php", [
                "message" => $formUserName.'a été supprimé de la base',
                'userInfos' => $users,
                'your_id' => $userId,
                'tailwind' => [false, '/public/js/tailwind.js']
            ], "backoffice", $styleLinks, $scripts);
        } else {
            header('Location: \?error=nousertodelete');
        }

    }

    #[Route('/updateUser', name: "updateUser", methods: ["POST"])]
    public function updateUser()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST['update-user'])) {

                $UserName =  filter_input(INPUT_POST, "username-checked");
                $formUserId = intval(htmlspecialchars($_POST['userId']));
                $userManager = new UserManager(new PDOFactory());
                $user = $userManager->getByUsername($UserName);

                if($user) {
                    $args = [];
                    $updateFeed = [
                        'first_name' => filter_input( INPUT_POST, "first_name") ?? null,
                        'last_name' => filter_input( INPUT_POST, "last_name") ?? null,
                        'email' => filter_input( INPUT_POST, "email") ?? null,
                        'birth_date' => filter_input( INPUT_POST, "birth_date") ?? null,
                        'password' => filter_input( INPUT_POST, "password") ?? null,
                        'username' => filter_input( INPUT_POST, "username") ?? null,
                        'status' => filter_input( INPUT_POST, "status") ?? null,
                    ];
                    foreach($updateFeed as $key => $value) {
                        if($value !== null) {
                            $args[$key] = $value;
                        }
                    }

                    $userManager->updateUser($formUserId, $UserName, $args);
                    $userId = intval($_SESSION['userId']);
                    $styleLinks = [];
                    $scripts = [];

                    $this->render("admin/backoffice.php", [
                        "message" => $UserName.'a été modifié dans la base',
                        "your_id" => $userId,
                    ], "backoffice", $styleLinks, $scripts);
                } else {
                    header('Location: \?error=nousertoupdate');
                    exit();
                }
                header('Location: \?error=submitnotworking');
                exit();

            }
            header('Location: \?error=nopostmethod');
            exit();
        }

    }
}


