<?php

namespace Gladblog\Entity;

use Gladblog\Exception\DomainException;

class Comments extends BaseEntity
{
    /**
     * @var array<string, string>
     */
    protected array $hydrationMap = [
        'id_comment' => 'setId_comment',
        'author_comment' => 'setAuthor_comment',
        'publish_date' => 'setPublish_date',
        'content_comment' => 'setContent_comment',
        'id_post' => 'setId_post',
        'id_upper_comment' => 'setId_upper_comment',
        'post_title' => 'setPost_title',
        'admin_comment' => 'setAdmin_comment',
    ];

    private int $id_comment;
    private string $author_comment;
    private ?string $publish_date = null;
    private string $content_comment;
    private int $id_post;
    private ?int $id_upper_comment = null;
    private string | null $post_title = null;
    private int | null $admin_comment = 0;

    /**
     * Crée un commentaire (éventuellement réponse) avec validation métier.
     */
    public static function write(
        string $author,
        string $content,
        int $postId,
        string $postTitle,
        bool $fromAdmin = false,
        ?int $parentCommentId = null
    ): self {
        $author = trim($author);
        $content = trim($content);

        if ($author === '') {
            throw new DomainException('L\'auteur du commentaire est obligatoire.');
        }
        if ($content === '') {
            throw new DomainException('Le contenu du commentaire est obligatoire.');
        }
        if ($postId <= 0) {
            throw new DomainException('Le post associé est invalide.');
        }

        $comment = new self();
        $comment->setAuthor_comment($author);
        $comment->setContent_comment($content);
        $comment->setId_post($postId);
        $comment->setPost_title($postTitle);
        $comment->setAdmin_comment($fromAdmin ? 1 : 0);
        $comment->setId_upper_comment($parentCommentId);

        return $comment;
    }

    public function isReply(): bool
    {
        return $this->id_upper_comment !== null && $this->id_upper_comment > 0;
    }

    public function isAdminComment(): bool
    {
        return (int) $this->admin_comment === 1;
    }

    public function isWrittenBy(string $username): bool
    {
        return strcasecmp($this->author_comment, $username) === 0;
    }

    public function belongsToPost(int $postId): bool
    {
        return $this->id_post === $postId;
    }

    public function markAsAdminComment(): self
    {
        $this->admin_comment = 1;
        return $this;
    }

    public function getPost_title(): ?string
    {
        return $this->post_title;
    }

    public function setPost_title(?string $post_title): void
    {
        $this->post_title = $post_title;
    }

    public function getAdmin_comment(): ?int
    {
        return $this->admin_comment;
    }

    public function setAdmin_comment(?int $admin_comment): void
    {
        $this->admin_comment = $admin_comment;
    }

    public function getId_comment(): int
    {
        return $this->id_comment;
    }

    public function setId_comment(int $id_comment): void
    {
        $this->id_comment = $id_comment;
    }

    public function getAuthor_comment(): string
    {
        return $this->author_comment;
    }

    public function setAuthor_comment(string $author_comment): void
    {
        $this->author_comment = $author_comment;
    }

    public function getPublish_date()
    {
        return $this->publish_date;
    }

    public function setPublish_date(string | null $publish_date): void
    {
        $this->publish_date = $publish_date;
    }

    public function getContent_comment(): string
    {
        return $this->content_comment;
    }

    public function setContent_comment(string $content_comment): void
    {
        $this->content_comment = $content_comment;
    }

    public function getId_post(): int
    {
        return $this->id_post;
    }

    public function setId_post(int $id_post): void
    {
        $this->id_post = $id_post;
    }

    public function getId_upper_comment(): ?int
    {
        return $this->id_upper_comment;
    }

    public function setId_upper_comment(?int $id_upper_comment): void
    {
        $this->id_upper_comment = $id_upper_comment;
    }
}
