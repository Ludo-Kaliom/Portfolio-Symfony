<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProjectsRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ProjectsRepository::class)]
/**
 * @Vich\Uploadable
 */
class Projects
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    /**
     * @Vich\UploadableField(mapping="image_files", fileNameProperty="image")
     * @var File
     */
    private $imageFiles;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    private $short_description;

    #[ORM\Column(type: 'string', length: 255)]
    private $category;

    #[ORM\Column(type: 'string', length: 255)]
    private $subtitle;

    #[ORM\Column(type: 'text')]
    private $item;

    #[ORM\Column(type: 'string', length: 255)]
    private $site_label;

    #[ORM\Column(type: 'string', length: 255)]
    private $site_link;

    #[ORM\Column(type: 'string', length: 255)]
    private $git_label;

    #[ORM\Column(type: 'string', length: 255)]
    private $git_link;

    #[ORM\Column(type: 'integer')]
    private $priority;

    #[ORM\Column(type: 'boolean')]
    private $status;

    #[ORM\ManyToMany(targetEntity: Technologies::class, inversedBy: 'projects')]
    private $technologies;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updated_at;

    public function __construct()
    {
        $this->technologies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageFiles(): ?File
    {
        return $this->imageFiles;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $documentFile
     */
    public function setImageFiles(?File $image = null): void
    {
        $this->imageFiles = $image;

        if (null !== $image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updated_at = new \DateTime();
        }
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
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

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(string $short_description): self
    {
        $this->short_description = $short_description;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getItem(): ?string
    {
        return $this->item;
    }

    public function setItem(string $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getSiteLabel(): ?string
    {
        return $this->site_label;
    }

    public function setSiteLabel(string $site_label): self
    {
        $this->site_label = $site_label;

        return $this;
    }

    public function getSiteLink(): ?string
    {
        return $this->site_link;
    }

    public function setSiteLink(string $site_link): self
    {
        $this->site_link = $site_link;

        return $this;
    }

    public function getGitLabel(): ?string
    {
        return $this->git_label;
    }

    public function setGitLabel(string $git_label): self
    {
        $this->git_label = $git_label;

        return $this;
    }

    public function getGitLink(): ?string
    {
        return $this->git_link;
    }

    public function setGitLink(string $git_link): self
    {
        $this->git_link = $git_link;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Technologies>
     */
    public function getTechnologies(): Collection
    {
        return $this->technologies;
    }

    public function addTechnology(Technologies $technology): self
    {
        if (!$this->technologies->contains($technology)) {
            $this->technologies[] = $technology;
        }

        return $this;
    }

    public function removeTechnology(Technologies $technology): self
    {
        $this->technologies->removeElement($technology);

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
