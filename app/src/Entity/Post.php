<?php
// Model => l'entity va créer les getter et setter qui vont être utilisé par le manager pour envoyer en BDD
// SETTER pour envoyer à la BDD et getter pour prendre de la la BDD
// Nous utilisons baseEntity afin d'hydrater avec la data
// Grâce à l'hydrator et BaseEntity on a plus qu'à faire $this->id (si getter pour prendre le contenu existant) ou $this->id = $id pour créer le contenu et ça marche (lisibilité)
// Avec cette class on pourra fournir les id, content et author

namespace Gladblog\Entity;

class Post extends BaseEntity
{
    private int | null $postid;
    private string | null $content;
    private int | null $author;
    private string | null $author_name;
    private string | null $title;
    private int | null $articleStatus;
    private string | null $image;

    /**
     * @return int
     */
    public function getIdpost(): int | null
    {
        return $this->postid;
    }

    /**
     * @param int $postid
     * @return Post
     */
    public function setIdpost(int | null $postid): Post | null
    {
        $this->postid = $postid;
        return $this;
    }

    /**
     * @return int
     */
    public function getArticleStatus(): int | null
    {
        return $this->articleStatus;
    }

    /**
     * @param int $articleStatus
     * @return Post
     */
    public function setArticleStatus(int | null $articleStatus): Post
    {
        $this->articleStatus = $articleStatus;
        return $this;
    }


    /**
     * @return string|null
     */
    public function getAuthor_name(): string | null
    {
        return $this->author_name;
    }

    /**
     * @param string|null $author_name
     * @return $this
     */
    public function setAuthor_name(string | null $author_name): Post
    {
        $this->author_name = $author_name;
        return $this;
    }


    /**
     * @return string|null
     */
    public function getImage(): string | null
    {
        return $this->image;
    }


    /**
     * @param string|null $image
     * @return $this
     */
    public function setImage(string | null $image): Post
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string | null
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Post
     */
    public function setContent(string | null $content): Post
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return int
     */
    public function getAuthor(): int | null
    {
        return $this->author;
    }

    /**
     * @param int $author
     * @return Post
     */
    public function setAuthor(int | null $author): Post
    {
        $this->author = $author;
        return $this;
    }

    public function getTitle(): string | null
    {
        return $this->title;
    }

    public function setTitle(string | null $title): Post
    {
        $this->title = $title;
        return $this;
    }
}