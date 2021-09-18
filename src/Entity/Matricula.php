<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matricula
 *
 * @ORM\Table(name="matriculas", indexes={@ORM\Index(name="fk_mat_user", columns={"usuario_id"})})
 * @ORM\Entity
 */
class Matricula
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
     * @ORM\Column(name="matriculas", type="string", length=10, nullable=true)
     */
    private $matriculas;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatriculas(): ?string
    {
        return $this->matriculas;
    }

    public function setMatriculas(?string $matriculas): self
    {
        $this->matriculas = $matriculas;

        return $this;
    }

}
