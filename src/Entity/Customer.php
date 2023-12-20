<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[UniqueEntity(fields: ['email', 'reseller'], message: "Un client avec cette adresse mail existe déjà dans votre portefeuille.")]
#[ApiResource]
class Customer
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le prénom de votre client ne doit pas être vide.")]
    #[Assert\Length(
        min: 2,
        minMessage: "Le prénom de votre client doit avoir au moins { limit } caractères."
    )]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le nom de votre client ne doit pas être vide.")]
    #[Assert\Length(
        min: 2,
        minMessage: "Le nom de votre client doit avoir au moins { limit } caractères."
    )]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Veuillez renseigner une adresse mail pour votre client.")]
    #[Assert\Email(message: "Veuillez renseigner une adresse mail valide pour votre client.")]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Veuillez renseigner une adresse postale pour votre client.")]
    private ?string $address = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToMany(targetEntity: Reseller::class, inversedBy: 'customers', cascade: ['persist'])]
    private Collection $reseller;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();

        $this->reseller = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Reseller>
     */
    public function getReseller(): Collection
    {
        return $this->reseller;
    }

    public function addReseller(Reseller $reseller): static
    {
        if (!$this->reseller->contains($reseller)) {
            $this->reseller->add($reseller);
        }

        return $this;
    }

    public function removeReseller(Reseller $reseller): static
    {
        $this->reseller->removeElement($reseller);

        return $this;
    }
}
