<?php
namespace Gladblog\Controllers;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
use Gladblog\Factory\PDOFactory;
use Gladblog\Manager\CommentsManager;
use Gladblog\Manager\PostManager;
use Gladblog\Route\Route;

class CommentsController extends AbstractController
{
    #[Route('/register_comment', name: "comment", methods: ["POST", "GET"])]
    public function register_comment()
    {

        $author_comment = htmlspecialchars($_POST['author_comment']);
        $content_comment = htmlspecialchars($_POST['content_comment']);
        $id_post = intval($_POST['id_post']);
        $post_title = htmlspecialchars($_POST['post_title']);
        $user_id = intval($_POST['userId']);
        $admin_comment = 0;
        $PostsManager = new PostManager(new PDOFactory());
        $CommentsManager = new CommentsManager(new PDOFactory());
        $posts = $PostsManager->getAllPosts();
        $comments = $CommentsManager->getAllComments();
        $comment = $CommentsManager->getComment($id_post);
        $CommentsManager->insertNewComment($author_comment, $content_comment, $id_post, $post_title, $admin_comment);
        $message = "";
        $styleLinks = [];
        $scripts = [];

        $this->render("users/writer.php", [
            'message' => 'Vous avez bien commenté le post n°'.$id_post.'.',
            'posts' => $posts,
            'comment' => $comment,
            'comments' => $comments,
            'post_id' => $id_post
        ], "Espace de lecture", $styleLinks, $scripts);

    }
}