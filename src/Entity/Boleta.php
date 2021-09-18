<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Boleta
 *
 * @ORM\Table(name="boletas", indexes={@ORM\Index(name="fk_bol_user", columns={"usuario_id"})})
 * @ORM\Entity
 */
class Boleta
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="boleta", type="string", length=10, nullable=true)
     */
    private $boleta;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBoleta(): ?string
    {
        return $this->boleta;
    }

    public function setBoleta(?string $boleta): self
    {
        $this->boleta = $boleta;

        return $this;
    }

}
