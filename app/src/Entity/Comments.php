<?php
namespace Gladblog\Entity;

class Comments extends BaseEntity
{
    private int $id_comment;
    private string $author_comment;
    private ?string $publish_date;
    private string $content_comment;
    private int $id_post;
    private ?int $id_upper_comment;
    private string | null $post_title;
    private int | null $admin_comment;

    /**
     * @return string|null
     */
    public function getPost_title(): ?string
    {
        return $this->post_title;
    }

    /**
     * @param string|null $post_title
     */
    public function setPost_title(?string $post_title): void
    {
        $this->post_title = $post_title;
    }

    /**
     * @return int|null
     */
    public function getAdmin_comment(): ?int
    {
        return $this->admin_comment;
    }

    /**
     * @param int|null $admin_comment
     */
    public function setAdmin_comment(?int $admin_comment): void
    {
        $this->admin_comment = $admin_comment;
    }

    /**
     * @return int
     */
    public function getId_comment(): int
    {
        return $this->id_comment;
    }

    /**
     * @param int $id_comment
     */
    public function setId_comment(int $id_comment): void
    {
        $this->id_comment = $id_comment;
    }

    /**
     * @return string
     */
    public function getAuthor_comment(): string
    {
        return $this->author_comment;
    }

    /**
     * @param string $author_comment
     */
    public function setAuthor_comment(string $author_comment): void
    {
        $this->author_comment = $author_comment;
    }

    /**
     * @return mixed
     */
    public function getPublish_date()
    {
        return $this->publish_date;
    }

    /**
     * @param mixed $publish_date
     */
    public function setPublish_date(string | null $publish_date): void
    {
        $this->publish_date = $publish_date;
    }

    /**
     * @return string
     */
    public function getContent_comment(): string
    {
        return $this->content_comment;
    }

    /**
     * @param string $content_comment
     */
    public function setContent_comment(string $content_comment): void
    {
        $this->content_comment = $content_comment;
    }

    /**
     * @return int
     */
    public function getId_post(): int
    {
        return $this->id_post;
    }

    /**
     * @param int $id_post
     */
    public function setId_post(int $id_post): void
    {
        $this->id_post = $id_post;
    }

    /**
     * @return int|null
     */
    public function getId_upper_comment(): ?int
    {
        return $this->id_upper_comment;
    }

    /**
     * @param int|null $id_upper_comment
     */
    public function setId_upper_comment(?int $id_upper_comment): void
    {
        $this->id_upper_comment = $id_upper_comment;
    }

}