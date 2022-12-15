<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;

use App\Repository\CheeseListingRepository;
use Doctrine\ORM\Mapping as ORM;
use Carbon\Carbon;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CheeseListingRepository::class)]
#[ApiResource(
    // reading data --> normalization
    normalizationContext: [
        'groups' => ['cheese_listing:read'], 
        'swagger_definition_name' => 'Read'
    ], // ['groups' => ['[GROUP_NAME]:read']]
    // writing data --> normalization
    denormalizationContext: [
        'groups' => ['cheese_listing:write'],
        'swagger_definition_name' => 'Write'
    ],
    shortName: "cheeses"
)]
class CheeseListing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['cheese_listing:read', 'cheese_listing:write'])] // #[Groups(['[GROUP_NAME]:read'])]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Groups(['cheese_listing:read'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['cheese_listing:read', 'cheese_listing:write'])]
    private ?int $price = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?bool $isPublished = false;


    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
    
    /**
     * The description of the cheese as raw text.
     */
    #[Groups(['cheese_listing:write'])]
    public function setTextDescription(string $description): self
    {
        $this->description = nl2br($description);

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }
    
    /**
     * How long ago in text that this cheese listing was added.
     */
    #[Groups(['cheese_listing:read'])]
    public function getCreatedAtAgo(): string
    {
        return Carbon::instance($this->getCreatedAt())->diffForHumans();
    }

    public function isIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }
}
