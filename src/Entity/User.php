<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="N'oubliez pas votre prenom.")
     * @Groups({"product:read","product:write"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="N'oubliez pas votre nom.")
     * @Assert\Length(max="255", maxMessage="Attention, pas plus de 255 caractères.")

     * @Groups({"product:read","product:write"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="N'oubliez pas votre email.")
     * @Assert\Length(max="255", maxMessage="Attention, pas plus de 255 caractères.")

     * @Groups({"product:read","product:write"})
     */
    private $email;

    /**
     * @var string The hashed password
     * @Assert\NotBlank(message="N'oubliez pas votre mot de passe.")
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="array")
     * @Groups({"product:read","product:write"})
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="user")
     */
    private $products;

    public function __construct($role = 'ROLE_USER')
    {
        $this->products = new ArrayCollection();
        $this->roles[] = $role; # TODO Créer une fonction addRole.
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setUser($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getUser() === $this) {
                $product->setUser(null);
            }
        }

        return $this;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }
}
