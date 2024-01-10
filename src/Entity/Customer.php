<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as CustomAssert;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[ORM\UniqueConstraint(fields: ['email', 'reseller'])]
#[CustomAssert\IsCustomersExist()]
#[UniqueEntity(fields: ['email', 'reseller'], message: "Un client avec cette adresse mail existe déjà dans votre portefeuille.")]
#[ApiResource(
    operations: [
                 new Post(
                     denormalizationContext: ['groups' => ['customer:write']],
                 ),
                 new GetCollection(
                     normalizationContext: ['groups' => ['customer:read']]
                 ),
                 new Get(
                     normalizationContext: ['groups' => ['customer:read']]
                 ),
                 new Delete(
                     denormalizationContext: ['groups' => ['customer:write']],
                     security: "is_granted('ROLE_USER') and object.getReseller() == user",
                 )
                ],
)]
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
        minMessage: "Le prénom de votre client doit avoir au moins {{ limit }} caractères."
    )]
    #[Groups(['customer:read', 'customer:write'])]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le nom de votre client ne doit pas être vide.")]
    #[Assert\Length(
        min: 2,
        minMessage: "Le nom de votre client doit avoir au moins {{ limit }} caractères."
    )]
    #[Groups(['customer:read', 'customer:write'])]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Veuillez renseigner une adresse mail pour votre client.")]
    #[Assert\Email(message: "Veuillez renseigner une adresse mail valide pour votre client.")]
    #[Groups(['customer:read', 'customer:write'])]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Veuillez renseigner une adresse postale pour votre client.")]
    #[Groups(['customer:read', 'customer:write'])]
    private ?string $address = null;

    #[ORM\Column]
    #[Groups(['customer:read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(targetEntity: Reseller::class, cascade: ['persist'], inversedBy: 'customers')]
    private Reseller $reseller;


    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
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

    public function getReseller(): Reseller
    {
        return $this->reseller;
    }

    public function setReseller(?Reseller $reseller): static
    {
        $this->reseller = $reseller;

        return $this;
    }
}
