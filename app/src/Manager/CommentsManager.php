<?php
namespace Gladblog\Manager;

use Gladblog\Entity\Post;
use Gladblog\Entity\Comments;

class CommentsManager extends BaseManager
{
    public function getAllComments(): array
    {
        $query = $this->pdo->query("select * from comments");
        $comments = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $comments[] = new Comments($data);
        }

        return $comments;
    }

    public function getComment(int $id_post): array
    {
        $query = $this->pdo->prepare("select * from comments WHERE id_post = :id_post");
        $query->execute([
            'id_post' => $id_post
        ]);
        $comments = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $comments[] = new Comments($data);
        }

        return $comments;
    }

    public function insertNewComment(Comments $comment): void
    {
        $query = $this->pdo->prepare("INSERT INTO comments (author_comment, content_comment, id_post, post_title, admin_comment, id_upper_comment, publish_date)
                                                VALUES (:author_comment, :content_comment, :id_post, :post_title, :admin_comment, :id_upper_comment, NOW())");
        $query->execute([
            'author_comment' => $comment->getAuthor_comment(),
            'content_comment' => $comment->getContent_comment(),
            'id_post' => $comment->getId_post(),
            'post_title' => $comment->getPost_title(),
            'admin_comment' => $comment->getAdmin_comment() ?? 0,
            'id_upper_comment' => $comment->getId_upper_comment(),
        ]);
    }
}