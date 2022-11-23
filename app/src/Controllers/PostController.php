<?php
// Je requière mon model (ici Post qui a lui-même requis l'entité Post)
// D'où le namespace doit être utilisé pour accéder en direct à la class PostManager
// Mais via composition, je requière aussi la factory c'est à dire ici un PDO
// (nécessaire pour instancier le PostManager car il l'a en param: un objet en param donc un PDO particulier)

namespace Gladblog\Controllers;
use Gladblog\Factory\PDOFactory;
use Gladblog\Manager\PostManager;
use Gladblog\Route\Route;
// inutile:
//use Gladblog\Controller\AbstractController;

class PostController extends AbstractController
{
    // Ici Route a vocation à être instancié en tant que objet donc on le prépare mais c'est un commentaire et c'est l'API de reflexivité qui permettra
    // de instancier Route ainsi que de rattacher la fonction en dessous pour rendre la page et les données qu'on utilise dessus (comme en FLASK).
    #[Route('/', name: "homepage", methods: ["GET"])]
    public function home()
    {
        $showAllPosts = new PostManager(new PDOFactory());
        $posts = $showAllPosts->getAllPosts();

        $styleLinks = ['/public/css/style.css',
                       '/public/css/base.css',
                       '/public/lib/materialize/css/materialize.css',
                       'https://fonts.googleapis.com/icon?family=Material+Icons'
                      ];
        $scripts = ['/public/lib/materialize/js/materialize.js'];

        $this->render("home.php", [
            "posts" => $posts,
        ], "Votre homepage", $styleLinks, $scripts);
    }

    #[Route('/writer', name: "writerpage", methods: ["GET"])]
    public function writerByGet()
    {
     $postId = $_GET['id'] ?? null;
     $showAllPosts = new PostManager(new PDOFactory());
     $posts = $showAllPosts->getAllPosts();
     if(isset($postId)) {
         $showAllPosts->deletePost($postId);
         header('Location: /writer?success=deletedpost');
     }

    $styleLinks = ['/public/css/style.css',
        '/public/css/base.css',
        //'/public/lib/materialize/css/materialize.css',
        //'https://fonts.googleapis.com/icon?family=Material+Icons'
    ];
    $scripts = [
        //'/public/lib/materialize/js/materialize.js'
    ];

    $this->render("users/writer.php", [
        'posts' => $posts ?? null,
        'myPost' => $myPosts ?? null,
        'tailwind' => false
    ], "Espace d'écriture", $styleLinks, $scripts);
    }

    #[Route('/writer', name: "writer", methods: ["POST"])]
    public function writerByPost()
    {
        $showAllPosts = new PostManager(new PDOFactory());
        $posts = $showAllPosts->getAllPosts();

        $styleLinks = ['/public/css/style.css',
            '/public/css/base.css',
            //'/public/lib/materialize/css/materialize.css',
            'https://fonts.googleapis.com/icon?family=Material+Icons'
        ];
        $scripts = [
            //'/public/lib/materialize/js/materialize.js'
        ];

        $this->render("users/writer.php", [
            'posts' => $posts,
            'tailwind' => false
        ], "Espace d'écriture", $styleLinks, $scripts);
    }

     #[Route('/register_post', name: "writer", methods: ["POST"])]
     public function register_post()
     {
           if(isset($_POST['register_article'])) {

                $postManager = new PostManager(new PDOFactory());
                $title = filter_input(INPUT_POST, 'title');
                $content = filter_input(INPUT_POST, 'content');
                $postManager->insertPost($title, $content);
                header('Location: /writer?success=newarticle');
                exit();
           } else   {
           header('Location: /writer?error=submitnull');
           exit();
           }
     }
}