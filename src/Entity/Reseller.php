<?php

namespace App\Entity;

//use ApiPlatform\Metadata\ApiResource;
//use ApiPlatform\Metadata\Post;
use App\Repository\ResellerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ResellerRepository::class)]
#[UniqueEntity(fields: 'email')]
//#[ApiResource(
//    operations: [new Post(),],
//    denormalizationContext: [
//        'groups' => ['reseller:write'],
//    ]
//)]
class Reseller implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
//    #[Assert\Email(message: "Ceci n'est pas une adresse mail valide.")]
//    #[Assert\NotBlank]
//    #[Groups(['reseller:write'])]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

//    #[Assert\NotBlank(message: "Veuillez saisir un mot de passe.")]
//    #[Assert\Length(
//        min: 6,
//        max: 50,
//        minMessage: "Votre mot de passe doit contenir au moins { limit } caractères.",
//        maxMessage: "Votre mot de passe doit contenir au plus { limit } caractères.",
//    )]
//    #[Groups(['reseller:write'])]
//    #[SerializedName('password')]
    private ?string $plainPassword = null;

    #[ORM\Column(length: 255)]
//    #[Groups(['reseller:write'])]
//    #[Assert\NotBlank(message: "Votre nom ne doit pas être vide.")]
//    #[Assert\Length(
//        min: 3,
//        minMessage: "Votre nom doit avoir au moins { limit } caractères."
//    )]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
//    #[Groups(['reseller:write'])]
//    #[Assert\NotBlank(message: "Le nom de votre société ne doit pas être vide.")]
//    #[Assert\Length(
//        min: 3,
//        minMessage: "Le nom de votre société doit avoir au moins { limit } caractères."
//    )]
    private ?string $companyName = null;

    #[ORM\OneToMany(targetEntity: Customer::class, mappedBy: 'reseller', cascade: ['persist'])]
    private Collection $customers;

    public function __construct()
    {
        $this->customers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @param string|null $plainPassword
     */
    public function setPlainPassword(?string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
         $this->plainPassword = null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): static
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * @return Collection<int, Customer>
     */
    public function getCustomers(): Collection
    {
        return $this->customers;
    }

    public function addCustomer(Customer $customer): static
    {
        if (!$this->customers->contains($customer)) {
            $this->customers->add($customer);
            $customer->addReseller($this);
        }

        return $this;
    }

    public function removeCustomer(Customer $customer): static
    {
        if ($this->customers->removeElement($customer)) {
            $customer->removeReseller($this);
        }

        return $this;
    }
}
