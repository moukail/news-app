<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

use App\Repository\ItemRepository;

#[ORM\Table(name: 'feed_items')]
#[ORM\Entity(repositoryClass: ItemRepository::class)]
class FeedItem
{
    #[ORM\Id]
    #[ORM\Column(type: "string", unique: true)]
    private string $id;

    #[ORM\Column]
    #[Groups(groups: ["user", "manager"])]
    #[Assert\NotBlank]
    private string $title;

    #[ORM\Column]
    #[Groups(groups: ["user", "manager"])]
    #[Assert\NotBlank]
    private string $link;

    #[ORM\Column(type: 'text')]
    #[Groups(groups: ["user", "manager"])]
    #[Assert\NotBlank]
    private string $description;

    #[ORM\Column(type: 'text')]
    #[Groups(groups: ["user", "manager"])]
    #[Assert\NotBlank]
    private string $article;

    #[ORM\ManyToOne(targetEntity:Feed::class)]
    #[ORM\JoinColumn(nullable:false)]
    private Feed $feed;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): self
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getArticle(): string
    {
        return $this->article;
    }

    /**
     * @param string $article
     */
    public function setArticle(string $article): self
    {
        $this->article = $article;
        return $this;
    }

    /**
     * @return Feed
     */
    public function getFeed(): Feed
    {
        return $this->feed;
    }

    /**
     * @param Feed $feed
     */
    public function setFeed(Feed $feed): self
    {
        $this->feed = $feed;
        return $this;
    }
}