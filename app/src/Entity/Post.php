<?php

namespace Gladblog\Entity;

use Gladblog\Exception\DomainException;

class Post extends BaseEntity
{
    public const STATUS_PUBLIC = 1;
    public const STATUS_PRIVATE = 2;

    private int | null $postid = null;
    private string | null $content = null;
    private int | null $author = null;
    private string | null $author_name = null;
    private string | null $title = null;
    private int | null $articleStatus = null;
    private string | null $image = null;

    /**
     * Crée un article prêt à être persisté, avec validation métier.
     */
    public static function compose(
        string $title,
        string $content,
        string $authorName,
        int $authorId,
        int $visibility,
        string $image
    ): self {
        $title = trim($title);
        $content = trim($content);

        if ($title === '') {
            throw new DomainException('Le titre de l\'article est obligatoire.');
        }
        if ($content === '') {
            throw new DomainException('Le contenu de l\'article est obligatoire.');
        }
        if (!in_array($visibility, [self::STATUS_PUBLIC, self::STATUS_PRIVATE], true)) {
            throw new DomainException('Visibilité invalide (public=1, privé=2).');
        }
        if ($authorId <= 0) {
            throw new DomainException('Auteur invalide.');
        }

        $post = new self();
        $post->setTitle($title)
            ->setContent($content)
            ->setAuthor_name($authorName)
            ->setAuthor($authorId)
            ->setArticleStatus($visibility)
            ->setImage($image);

        return $post;
    }

    public function getIdpost(): int | null
    {
        return $this->postid;
    }

    public function setIdpost(int | null $postid): Post | null
    {
        $this->postid = $postid;
        return $this;
    }

    public function getArticleStatus(): int | null
    {
        return $this->articleStatus;
    }

    public function setArticleStatus(int | null $articleStatus): Post
    {
        $this->articleStatus = $articleStatus;
        return $this;
    }

    /**
     * Alias d’hydratation pour la colonne SQL `public`.
     */
    public function getPublic(): int | null
    {
        return $this->articleStatus;
    }

    public function setPublic(int | null $public): Post
    {
        $this->articleStatus = $public;
        return $this;
    }

    public function isPublic(): bool
    {
        return $this->articleStatus === self::STATUS_PUBLIC;
    }

    public function isPrivate(): bool
    {
        return $this->articleStatus === self::STATUS_PRIVATE;
    }

    public function publish(): self
    {
        $this->articleStatus = self::STATUS_PUBLIC;
        return $this;
    }

    public function makePrivate(): self
    {
        $this->articleStatus = self::STATUS_PRIVATE;
        return $this;
    }

    public function isOwnedBy(?int $userId): bool
    {
        return $userId !== null && $this->author !== null && $this->author === $userId;
    }

    public function canBeEditedBy(?User $user): bool
    {
        if ($user === null || $user->getId() === null) {
            return false;
        }

        return $user->isAdmin() || $this->isOwnedBy($user->getId());
    }

    public function canBeDeletedBy(?User $user): bool
    {
        return $this->canBeEditedBy($user);
    }

    public function canBeReadBy(?User $user): bool
    {
        if ($this->isPublic()) {
            return true;
        }

        return $this->canBeEditedBy($user);
    }

    public function getAuthor_name(): string | null
    {
        return $this->author_name;
    }

    public function setAuthor_name(string | null $author_name): Post
    {
        $this->author_name = $author_name;
        return $this;
    }

    public function getImage(): string | null
    {
        return $this->image;
    }

    public function setImage(string | null $image): Post
    {
        $this->image = $image;
        return $this;
    }

    public function getContent(): string | null
    {
        return $this->content;
    }

    public function setContent(string | null $content): Post
    {
        $this->content = $content;
        return $this;
    }

    public function getAuthor(): int | null
    {
        return $this->author;
    }

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
