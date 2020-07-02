<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaymentMethod
 *
 * @ORM\Table(name="payment_method")
 * @ORM\Entity(repositoryClass="App\Repository\PaymentMethodRepository")
 */
class PaymentMethod
{
    /**
     * @var int
     *
     * @ORM\Column(name="idpaying_method", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpayingMethod;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=45, nullable=false)
     */
    private $label;

    public function getIdpayingMethod(): ?int
    {
        return $this->idpayingMethod;
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
