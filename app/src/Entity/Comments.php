<?php
namespace Gladblog\Entity;

class Comments extends BaseEntity
{
    private int $id_comment;
    private string $author_comment;
    private $publish_date;
    private string $content_comment;
    private int $id_post;
    private ?int $id_upper_comment;

    /**
     * @return int
     */
    public function getIdComment(): int
    {
        return $this->id_comment;
    }

    /**
     * @param int $id_comment
     */
    public function setIdComment(int $id_comment): void
    {
        $this->id_comment = $id_comment;
    }

    /**
     * @return string
     */
    public function getAuthorComment(): string
    {
        return $this->author_comment;
    }

    /**
     * @param string $author_comment
     */
    public function setAuthorComment(string $author_comment): void
    {
        $this->author_comment = $author_comment;
    }

    /**
     * @return mixed
     */
    public function getPublishDate()
    {
        return $this->publish_date;
    }

    /**
     * @param mixed $publish_date
     */
    public function setPublishDate(string $publish_date): void
    {
        $this->publish_date = $publish_date;
    }

    /**
     * @return string
     */
    public function getContentComment(): string
    {
        return $this->content_comment;
    }

    /**
     * @param string $content_comment
     */
    public function setContentComment(string $content_comment): void
    {
        $this->content_comment = $content_comment;
    }

    /**
     * @return int
     */
    public function getIdPost(): int
    {
        return $this->id_post;
    }

    /**
     * @param int $id_post
     */
    public function setIdPost(int $id_post): void
    {
        $this->id_post = $id_post;
    }

    /**
     * @return int|null
     */
    public function getIdUpperComment(): ?int
    {
        return $this->id_upper_comment;
    }

    /**
     * @param int|null $id_upper_comment
     */
    public function setIdUpperComment(?int $id_upper_comment): void
    {
        $this->id_upper_comment = $id_upper_comment;
    }

}