<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payment
 *
 * @ORM\Table(name="payment", indexes={@ORM\Index(name="fk_payment_payment_category1_idx", columns={"payment_category_idpayment_category"}), @ORM\Index(name="fk_payment_user_idx", columns={"user_iduser"}), @ORM\Index(name="fk_payment_payment_method1_idx", columns={"payment_method_idpaying_method"})})
 * @ORM\Entity(repositoryClass="App\Repository\PaymentRepository")
 */
class Payment
{
    /**
     * @var int
     *
     * @ORM\Column(name="idpayment", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpayment;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float", precision=10, scale=0, nullable=false)
     */
    private $amount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \PaymentCategory
     *
     * @ORM\ManyToOne(targetEntity="PaymentCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="payment_category_idpayment_category", referencedColumnName="idpayment_category")
     * })
     */
    private $paymentCategoryIdpaymentCategory;

    /**
     * @var \PaymentMethod
     *
     * @ORM\ManyToOne(targetEntity="PaymentMethod")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="payment_method_idpaying_method", referencedColumnName="idpaying_method")
     * })
     */
    private $paymentMethodIdpayingMethod;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_iduser", referencedColumnName="iduser")
     * })
     */
    private $userIduser;

    public function getIdpayment(): ?int
    {
        return $this->idpayment;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPaymentCategoryIdpaymentCategory(): ?PaymentCategory
    {
        return $this->paymentCategoryIdpaymentCategory;
    }

    public function setPaymentCategoryIdpaymentCategory(?PaymentCategory $paymentCategoryIdpaymentCategory): self
    {
        $this->paymentCategoryIdpaymentCategory = $paymentCategoryIdpaymentCategory;

        return $this;
    }

    public function getPaymentMethodIdpayingMethod(): ?PaymentMethod
    {
        return $this->paymentMethodIdpayingMethod;
    }

    public function setPaymentMethodIdpayingMethod(?PaymentMethod $paymentMethodIdpayingMethod): self
    {
        $this->paymentMethodIdpayingMethod = $paymentMethodIdpayingMethod;

        return $this;
    }

    public function getUserIduser(): ?User
    {
        return $this->userIduser;
    }

    public function setUserIduser(?User $userIduser): self
    {
        $this->userIduser = $userIduser;

        return $this;
    }


}
