<?php

namespace App\Entity;

use App\Repository\FeedRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Table(name: 'feeds')]
#[ORM\Entity(repositoryClass: FeedRepository::class)]
class Feed
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    #[Groups(groups: ["manager"])]
    private int $id;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Groups(groups: ["manager"])]
    private string $type;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Groups(groups: ["manager"])]
    private string $name;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Groups(groups: ["manager"])]
    private string $language;

    #[ORM\Column]
    #[Groups(groups: ["manager"])]
    #[Assert\NotBlank]
    private string $link;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
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
    public function setLink(string $link): void
    {
        $this->link = $link;
    }
}