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
}