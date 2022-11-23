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

    public function getPostById(int $id): array
    {

        $query = $this->pdo->query("SELECT * FROM posts WHERE id= :id");
        $query->bindValue("id", $id, \PDO::PARAM_STR);
        $query->execute();
        $posts = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $posts[] = new Post($data);
        }

        return $posts;
    }
}