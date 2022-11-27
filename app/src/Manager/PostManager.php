<?php
// Je veux ici requerir tous les post présent en base de donnée
// Je requière les data des posts à mon entité Post.php

namespace Gladblog\Manager;

use Gladblog\Entity\Post;

class PostManager extends BaseManager
{
    /**
     * @return Post[]
     */
    public function getAllPosts(): array
    {
        $query = $this->pdo->query("select * from posts");
        $posts = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $posts[] = new Post($data);
        }

        return $posts;
    }

    public function insertPost(string $title, string $content): array
    {
            $query = $this->pdo->prepare("INSERT INTO posts (content, title)
                                                VALUES (:content, :title)");
            $query->bindValue("content", $content, \PDO::PARAM_STR);
            $query->bindValue("title", $title, \PDO::PARAM_STR);
            $query->execute();

            $posts = [];
            while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
                $posts[] = new Post($data);
            }

            return $posts;

    }

    public function insertComplexPost(string $title, string $content, string $author_name, int $articleStatus, string $image, $author): array
    {
        $query = $this->pdo->prepare("INSERT INTO posts (content, title, public, image, author_name, author)
                                                VALUES (:content, :title, :public, :image, :author_name, :author)");
        $query->bindValue("content", $content, \PDO::PARAM_STR);
        $query->bindValue("title", $title, \PDO::PARAM_STR);
        $query->bindValue("public", $articleStatus, \PDO::PARAM_STR);
        $query->bindValue("image", $image, \PDO::PARAM_STR);
        $query->bindValue("author_name", $author_name, \PDO::PARAM_STR);
        $query->bindValue("author", $author, \PDO::PARAM_INT);
        $query->execute();

        $complexPosts = [];
        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $complexPosts[] = new Post($data);
        }

        return $complexPosts;

    }

    public function getPost($post_id) {
        $getPostReq = $this->pdo->prepare("SELECT * FROM posts WHERE idpost = :post_id");
        $getPostReq->execute([
            'post_id' => $post_id
        ]);
        $readPosts = [];
        while ($data = $getPostReq->fetch(\PDO::FETCH_ASSOC)) {
            $readPosts[] = new Post($data);
        }
        return $readPosts;
    }

    public function deletePost($post_id){
        $dropPostReq = $this->pdo->prepare("DELETE FROM posts WHERE idpost = :post_id");
        $dropPostReq->execute([
            'post_id' => $post_id
        ]);
    }
}