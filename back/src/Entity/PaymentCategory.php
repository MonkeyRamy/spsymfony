<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaymentCategory
 *
 * @ORM\Table(name="payment_category", indexes={@ORM\Index(name="fk_payment_category_category_type1_idx", columns={"category_type_idcategory_type"})})
 * @ORM\Entity(repositoryClass="App\Repository\PaymentCategoryRepository")
 */
class PaymentCategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="idpayment_category", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpaymentCategory;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=45, nullable=false)
     */
    private $label;

    /**
     * @var \CategoryType
     *
     * @ORM\ManyToOne(targetEntity="CategoryType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category_type_idcategory_type", referencedColumnName="idcategory_type")
     * })
     */
    private $categoryTypeIdcategoryType;

    public function getIdpaymentCategory(): ?int
    {
        return $this->idpaymentCategory;
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

    public function getCategoryTypeIdcategoryType(): ?CategoryType
    {
        return $this->categoryTypeIdcategoryType;
    }

    public function setCategoryTypeIdcategoryType(?CategoryType $categoryTypeIdcategoryType): self
    {
        $this->categoryTypeIdcategoryType = $categoryTypeIdcategoryType;

        return $this;
    }


}
