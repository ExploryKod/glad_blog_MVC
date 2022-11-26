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
                        '/public/css/masonry.css'
                      ];
        $scripts = ['/public/js/masonry.js',
            '/public/lib/masonry/masonry.pkgd.min.js'];

        $this->render("home.php", [
            "posts" => $posts,
            'tailwind' => [false, '/public/js/tailwind.js']
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
        'tailwind' => [false, '/public/js/tailwind.js']
    ], "Espace d'écriture", $styleLinks, $scripts);
    }

    #[Route('/writer', name: "writer", methods: ["POST"])]
    public function writerByPost()
    {
        $showAllPosts = new PostManager(new PDOFactory());
        $posts = $showAllPosts->getAllPosts();

        $styleLinks = ['/public/css/style.css',
            '/public/css/base.css',
            'https://fonts.googleapis.com/icon?family=Material+Icons'
        ];
        $scripts = [];

        $this->render("users/writer.php", [
            'posts' => $posts,
            'tailwind' => [false, '/public/js/tailwind.js']  
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

    #[Route('/register_complex_post', name: "writer", methods: ["POST"])]
    public function register_complex_post()
    {
        if(isset($_POST['register_article'])) {

            $postManager = new PostManager(new PDOFactory());
            $title = filter_input(INPUT_POST, 'title');
            $content = filter_input(INPUT_POST, 'content');
            $author_name = filter_input(INPUT_POST, 'author_name');
            $article_status = filter_input(INPUT_POST, 'article_status');
            $image = filter_input(INPUT_POST, 'image');
            $postManager->insertComplexPost($title, $content, $author_name, $article_status, $image);
            header('Location: /writer?success=newarticle');
            exit();
        } else   {
            header('Location: /writer?error=submitnull');
            exit();
        }
    }

    #[Route('/read', name: "read", methods: ["GET"])]
    public function read_single_post()
    {

            $post_id = intval($_GET['post_id']);
            $postManager = new PostManager(new PDOFactory());
            $thePost = $postManager->getPost($post_id);
            $posts = $postManager->getAllPosts();
//            $posts = $postManager->getPostbyid($post_id);

            $styleLinks = ['/public/css/style.css',
                '/public/css/base.css',
                'https://fonts.googleapis.com/icon?family=Material+Icons'
            ];
            $scripts = [

            ];

            $this->render("users/read.php", [
                'posts' => $posts,
                'thePost' => $thePost,
                'tailwind' => [false, '/public/js/tailwind.js']
            ], "Espace de lecture", $styleLinks, $scripts);

    }

    #[Route('/deletepost', name: "deletepost", methods: ["GET"])]
    public function delete_single_post()
    {

        $post_id = intval($_GET['post_id']);
        $postManager = new PostManager(new PDOFactory());
        $postManager->deletePost($post_id);
        $posts = $postManager->getAllPosts();

        $styleLinks = ['/public/css/style.css', '/public/css/base.css'];
        $scripts = [];

        $this->render("users/writer.php", [
            'posts' => $posts,
            'message' => 'Le post n°'.$post_id.' a bien été supprimé.',
            'tailwind' => [false, '/public/js/tailwind.js']
        ], "Espace d'écriture", $styleLinks, $scripts);

    }
}