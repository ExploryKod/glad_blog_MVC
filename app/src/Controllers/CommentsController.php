<?php

namespace Gladblog\Controllers;

use Gladblog\Entity\Comments;
use Gladblog\Exception\DomainException;
use Gladblog\Route\Route;

class CommentsController extends AbstractController
{
    #[Route('/register_comment', name: "comment", methods: ["POST", "GET"])]
    public function register_comment()
    {
        $id_post = intval($_POST['id_post'] ?? 0);

        try {
            $comment = Comments::write(
                htmlspecialchars((string) ($_POST['author_comment'] ?? '')),
                htmlspecialchars((string) ($_POST['content_comment'] ?? '')),
                $id_post,
                htmlspecialchars((string) ($_POST['post_title'] ?? '')),
                $this->session()->isAdmin()
            );
            $this->comments()->insertNewComment($comment);
            $message = 'Vous avez bien commenté le post n°' . $id_post . '.';
        } catch (DomainException $e) {
            $message = $e->getMessage();
        }

        $this->render("users/writer.php", [
            'message' => $message,
            'posts' => $this->posts()->getAllPosts(),
            'comment' => $this->comments()->getComment($id_post),
            'comments' => $this->comments()->getAllComments(),
            'post_id' => $id_post
        ], "Espace de lecture");
    }
}
