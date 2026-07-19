<?php

namespace Gladblog\Controllers;

use Gladblog\Entity\Comments;
use Gladblog\Exception\DomainException;
use Gladblog\Route\Route;

class CommentsController extends AbstractController
{
    #[Route('/register_comment', name: "comment", methods: ["POST"])]
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
            $this->redirect('/read?post_id=' . $id_post . '&success=comment');
        } catch (DomainException $e) {
            $this->redirect('/read?post_id=' . $id_post . '&error=' . urlencode($e->getMessage()));
        }
    }
}
