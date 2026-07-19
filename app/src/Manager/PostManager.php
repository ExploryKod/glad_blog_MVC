<?php
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

    public function insertNewPost(Post $post): void
    {
        $query = $this->pdo->prepare("INSERT INTO posts (content, title, public, image, author_name, author, post_date)
                                                VALUES (:content, :title, :public, :image, :author_name, :author, NOW())");
        $query->bindValue("content", $post->getContent(), \PDO::PARAM_STR);
        $query->bindValue("title", $post->getTitle(), \PDO::PARAM_STR);
        $query->bindValue("public", $post->getArticleStatus(), \PDO::PARAM_INT);
        $query->bindValue("image", $post->getImage(), \PDO::PARAM_STR);
        $query->bindValue("author_name", $post->getAuthor_name(), \PDO::PARAM_STR);
        $query->bindValue("author", $post->getAuthor(), \PDO::PARAM_INT);
        $query->execute();
    }

    /**
     * @return Post[]
     */
    public function getPublicPosts(): array
    {
        return array_values(array_filter(
            $this->getAllPosts(),
            static fn(Post $post): bool => $post->isPublic()
        ));
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

    public function findPost(int $postId): ?Post
    {
        $posts = $this->getPost($postId);

        return $posts[0] ?? null;
    }

    public function deletePost($post_id){
        $dropPostReq = $this->pdo->prepare("DELETE FROM posts WHERE idpost = :post_id");
        $dropPostReq->execute([
            'post_id' => $post_id
        ]);
    }
}