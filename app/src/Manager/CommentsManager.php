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

    public function insertNewComment(string $author_comment, string $content_comment, int $id_post, string $post_title, int $admin_comment): array
    {
        $query = $this->pdo->prepare("INSERT INTO comments (author_comment, content_comment, id_post, post_title, admin_comment, publish_date)
                                                VALUES (:author_comment, :content_comment, :id_post, :post_title, :admin_comment, NOW()) LIMIT 1");
        $query->execute([
            'author_comment' => $author_comment,
            'content_comment' => $content_comment,
            'id_post' => $id_post,
            'post_title' => $post_title,
            'admin_comment' => $admin_comment
        ]);

        $newComments = [];
        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $newComments[] = new Comments($data);
        }

        return $newComments;

    }
}