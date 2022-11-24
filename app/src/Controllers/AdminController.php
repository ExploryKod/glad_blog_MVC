<?php
namespace Gladblog\Controllers;

use Gladblog\Factory\PDOFactory;
use Gladblog\Manager\UserManager;
use Gladblog\Route\Route;

class AdminController extends AbstractController
{
    #[Route('/backoffice', name: "backOffice", methods: ["GET"])]
    public function accessBackoffice() {

        $userManager = new UserManager(new PDOFactory());
        $users = $userManager->getAllUsers();

        $styleLinks = [
            '/public/css/style.css',
            '/public/css/base.css',
//            '/public/lib/materialize/css/materialize.css',
            'https://fonts.googleapis.com/icon?family=Material+Icons'
        ];
        $scripts = [
//            '/public/lib/materialize/js/materialize.js',
            '/public/js/script.js'];

        $this->render("admin/backoffice.php", [
            "message" => '',
            "userInfos" => $users,
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

        if($user) {

            $userManager->deleteUser($formUserId, $formUserName);

            $styleLinks = ['/public/css/style.css',
                '/public/css/base.css',
//                '/public/lib/materialize/css/materialize.css',
                'https://fonts.googleapis.com/icon?family=Material+Icons'
            ];
            $scripts = [
//                         '/public/lib/materialize/js/materialize.js',
                        '/public/js/script.js'];

            $this->render("admin/backoffice.php", [
                "message" => $formUserName.'a été supprimé de la base',
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

                    $styleLinks = ['/public/css/style.css',
                        '/public/css/base.css',
//                        '/public/lib/materialize/css/materialize.css',
                        'https://fonts.googleapis.com/icon?family=Material+Icons'
                    ];
                    $scripts = [
//                        '/public/lib/materialize/js/materialize.js',
                                '/public/js/script.js'
                    ];

                    $this->render("admin/backoffice.php", [
                        "message" => $UserName.'a été modifié dans la base',
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


