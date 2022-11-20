<?php
// Model => l'entity va créer les getter et setter qui vont être utilisé par le manager pour envoyer en BDD
// SETTER pour envoyer à la BDD et getter pour prendre de la la BDD
// Nous utilisons baseEntity afin d'hydrater avec la data
// Grâce à l'hydrator et BaseEntity on a plus qu'à faire $this->id (si getter pour prendre le contenu existant) ou $this->id = $id pour créer le contenu et ça marche (lisibilité)
// Avec cette class on pourra fournir les id, content et author

namespace Gladblog\Entity;

class Post extends BaseEntity
{
    private int $id;
    private string $content;
    private int $author;
    private string $title;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Post
     */
    public function setId(int $id): Post
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Post
     */
    public function setContent(string $content): Post
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return int
     */
    public function getAuthor(): int
    {
        return $this->author;
    }

    /**
     * @param int $author
     * @return Post
     */
    public function setAuthor(int $author): Post
    {
        $this->author = $author;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Post
    {
        $this->title = $title;
        return $this;
    }
}