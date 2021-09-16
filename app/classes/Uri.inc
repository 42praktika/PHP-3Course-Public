<?php


class Uri
{
    private ?int $id;

    /**
     * @param int|mixed $parent_id
     */
    public function setParentId(int $parent_id): void
    {
        $this->parent_id = $parent_id;
    }

    /**
     * @param string $uri
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int|mixed
     */
    public function getParentId(): ?int
    {
        return $this->parent_id;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }
    private ?int $parent_id;
    private string $uri;

    /**
     * Uri constructor.
     * @param $uri
     * @param $id
     * @param ?int $parent_id
     */
    public function __construct($uri, ?int $id=null, ?int $parent_id = null)
    {
        $this->id = $id;
        $this->parent_id = $parent_id;
        $this->uri = $uri;
    }

    public function __toString()
    {
       return sprintf("%s %s %s", $this->getId(), $this->getParentId(), $this->getUri());
    }
}