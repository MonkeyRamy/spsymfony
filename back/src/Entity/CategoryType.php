<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoryType
 *
 * @ORM\Table(name="category_type")
 * @ORM\Entity(repositoryClass="App\Repository\CategoryTypeRepository")
 */
class CategoryType
{
    /**
     * @var int
     *
     * @ORM\Column(name="idcategory_type", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcategoryType;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=45, nullable=false)
     */
    private $label;

    public function getIdcategoryType(): ?int
    {
        return $this->idcategoryType;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }


}
