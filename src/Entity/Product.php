<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"product:read"}},
 *     denormalizationContext={"groups"={"product:write"}},
 *     attributes={
 *          "pagination_items_per_page"=10
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={"user": "exact" , "categories": "exact"})
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"product:read","product:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="N'oubliez pas votre titre.")
     * @Assert\Length(max="255", maxMessage="Attention, pas plus de 255 caractères.")
     * @Groups({"product:read","product:write"})
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(message="N'oubliez pas votre description.")
     * @Assert\Length(max="255", maxMessage="Attention, pas plus de 255 caractères.")
     * @Groups({"product:read","product:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="N'oubliez pas votre alias.")
     * @Assert\Length(max="255", maxMessage="Attention, pas plus de 255 caractères.")
     * @Groups({"product:read","product:write"})
     */
    private $alias;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="N'oubliez pas votre image.")
     * @Groups({"product:read","product:write"})
     */
    private $image;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="N'oubliez pas votre prix.")
     * @Assert\Length(max="255", maxMessage="Attention, pas plus de 255 caractères.")
     * @Groups({"product:read","product:write"})
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="products")
     * @Groups({"product:read","product:write"})
     */
    private $categories;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"product:read","product:write"})
     */
    private $user;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }
}
