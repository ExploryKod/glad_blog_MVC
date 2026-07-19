<?php
namespace Gladblog\Controllers;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
use Gladblog\Entity\Comments;
use Gladblog\Exception\DomainException;
use Gladblog\Factory\PDOFactory;
use Gladblog\Manager\CommentsManager;
use Gladblog\Manager\PostManager;
use Gladblog\Route\Route;

class CommentsController extends AbstractController
{
    #[Route('/register_comment', name: "comment", methods: ["POST", "GET"])]
    public function register_comment()
    {
        $PostsManager = new PostManager(new PDOFactory());
        $CommentsManager = new CommentsManager(new PDOFactory());
        $id_post = intval($_POST['id_post'] ?? 0);
        $posts = $PostsManager->getAllPosts();
        $comments = $CommentsManager->getAllComments();
        $commentList = $CommentsManager->getComment($id_post);

        try {
            $fromAdmin = !empty($_SESSION['userStatus']) && $_SESSION['userStatus'] === 'admin';
            $comment = Comments::write(
                htmlspecialchars((string) ($_POST['author_comment'] ?? '')),
                htmlspecialchars((string) ($_POST['content_comment'] ?? '')),
                $id_post,
                htmlspecialchars((string) ($_POST['post_title'] ?? '')),
                $fromAdmin
            );
            $CommentsManager->insertNewComment($comment);
            $message = 'Vous avez bien commenté le post n°' . $id_post . '.';
        } catch (DomainException $e) {
            $message = $e->getMessage();
        }

        $styleLinks = [];
        $scripts = [];

        $this->render("users/writer.php", [
            'message' => $message,
            'posts' => $posts,
            'comment' => $commentList,
            'comments' => $comments,
            'post_id' => $id_post
        ], "Espace de lecture", $styleLinks, $scripts);
    }
}
