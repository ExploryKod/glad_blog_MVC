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

    public function getPostbyauthor(int $author): array
    {
        if(isset($author)) {
            $query = $this->pdo->query("SELECT * FROM posts WHERE `author`= :author");

            $query->bindValue("author", $author, \PDO::PARAM_STR);
            $query->execute();
            $posts = [];

            while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
                $posts[] = new Post($data);
            }

            return $posts;
        }

        return [];
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

    public function insertComplexPost(string $title, string $content, string $author_name, int $articleStatus, string $image): array
    {
        $query = $this->pdo->prepare("INSERT INTO posts (content, title, public, image, author_name)
                                                VALUES (:content, :title, :public, :image, :author_name)");
        $query->bindValue("content", $content, \PDO::PARAM_STR);
        $query->bindValue("title", $title, \PDO::PARAM_STR);
        $query->bindValue("public", $articleStatus, \PDO::PARAM_STR);
        $query->bindValue("image", $image, \PDO::PARAM_STR);
        $query->bindValue("author_name", $author_name, \PDO::PARAM_STR);
        $query->execute();

        $complexPosts = [];
        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $complexPosts[] = new Post($data);
        }

        return $complexPosts;

    }

    public function deletePost(int $id){
        $dropPostReq = $this->pdo->prepare("DELETE FROM posts WHERE id = :id");
        $dropPostReq->bindValue("id", $id, \PDO::PARAM_STR);
        $dropPostReq->execute();
    }
}