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
    #[ORM\Column]
    #[ORM\GeneratedValue]
    #[Groups(groups: ["user", "manager"])]
    private int $id;

    #[ORM\Column(type: "string", unique: true)]
    #[Groups(groups: ["user", "manager"])]
    private string $guid;

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
    public function getGuid(): string
    {
        return $this->guid;
    }

    /**
     * @param string $guid
     */
    public function setGuid(string $guid): self
    {
        $this->guid = $guid;
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

    public function __serialize(): array
    {
        return [
            'id' => $this->id,
            'guid' => $this->guid,
            'title' => $this->title,
            'description' => $this->description,
            'link' => $this->link,
            'feed' => $this->feed->getId(),
        ];
    }

    public function __unserialize(array $data): void
    {
        foreach ( $data as $key => $value ) {
            $this->$key = $value;
        }
    }
}