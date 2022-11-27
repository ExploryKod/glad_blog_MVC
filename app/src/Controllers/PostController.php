<?php
// Je requière mon model (ici Post qui a lui-même requis l'entité Post)
// D'où le namespace doit être utilisé pour accéder en direct à la class PostManager
// Mais via composition, je requière aussi la factory c'est à dire ici un PDO
// (nécessaire pour instancier le PostManager car il l'a en param: un objet en param donc un PDO particulier)

namespace Gladblog\Controllers;
use Gladblog\Factory\PDOFactory;
use Gladblog\Manager\PostManager;
use Gladblog\Route\Route;
use Gladblog\Manager\CommentsManager;

class PostController extends AbstractController
{
    #[Route('/', name: "homepage", methods: ["GET"])]
    public function home()
    {
        $showAllPosts = new PostManager(new PDOFactory());
        $posts = $showAllPosts->getAllPosts();

        $styleLinks = [];
        $scripts = [];

        $this->render("home.php", [
            "posts" => $posts
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

    $styleLinks = [];
    $scripts = [];

    $this->render("users/writer.php", [
        'posts' => $posts ?? null
    ], "Espace d'écriture", $styleLinks, $scripts);
    }

    #[Route('/writer', name: "writer", methods: ["POST"])]
    public function writerByPost()
    {
        $showAllPosts = new PostManager(new PDOFactory());
        $posts = $showAllPosts->getAllPosts();

        $styleLinks = [];
        $scripts = [];

        $this->render("users/writer.php", [
            'posts' => $posts
        ], "Espace d'écriture", $styleLinks, $scripts);
    }


    #[Route('/register_post', name: "writer", methods: ["POST"])]
    public function register_post()
    {
        if(isset($_POST['register_article'])) {

            $postManager = new PostManager(new PDOFactory());
            $title = filter_input(INPUT_POST, 'title');
            $content = filter_input(INPUT_POST, 'content');
            $author_name = filter_input(INPUT_POST, 'post_author');
            $article_status = filter_input(INPUT_POST, 'article_status');
            $authorId = filter_input(INPUT_POST, 'userId');
            $image = filter_input(INPUT_POST, 'image');
            $postManager->insertNewPost($title, $content, $author_name, $article_status, $image, $authorId);
            header('Location: /writer?success=newarticle');
            exit();
        } else   {
            header('Location: /writer?error=submitnull');
            exit();
        }
    }

    #[Route('/read', name: "read", methods: ["GET", "POST"])]
    public function read_single_post()
    {
            $post_id = intval($_GET['post_id']);
            $postManager = new PostManager(new PDOFactory());
            $commentsManager = new CommentsManager(new PDOFactory());
            $thePost = $postManager->getPost($post_id);
            $posts = $postManager->getAllPosts();
            $comment = $commentsManager->getComment($post_id);

            $styleLinks = [];
            $scripts = [];

            $this->render("users/read.php", [
                'comment' => $comment,
                'posts' => $posts,
                'thePost' => $thePost,
                'id_post' => $post_id,
            ], "Espace de lecture", $styleLinks, $scripts);

    }

    #[Route('/deletepost', name: "deletepost", methods: ["GET"])]
    public function delete_single_post()
    {

        $post_id = intval($_GET['post_id']);
        $postManager = new PostManager(new PDOFactory());
        $postManager->deletePost($post_id);
        $posts = $postManager->getAllPosts();

        $styleLinks = [];
        $scripts = [];

        $this->render("users/writer.php", [
            'posts' => $posts,
            'message' => 'Le post n°'.$post_id.' a bien été supprimé.'
        ], "Espace d'écriture", $styleLinks, $scripts);

    }
}