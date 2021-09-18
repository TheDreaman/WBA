<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Email as BaseEmail;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

$validator = new EmailValidator();
$validator->isValid("@alumno.ipn.mx", new RFCValidation());

/**
 * Usuario
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity
 */
class Usuario implements UserInterface
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
     * @var string
     *
     * @ORM\Column(name="bol_mat", type="string", nullable=false)
     * @Assert\NotBlank
     * @Assert\Regex("/[0-9]+/")
     */
    private $bolMat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=30, nullable=true)
     * @Assert\NotBlank
     * @Assert\Regex("/[a-zA-Z ]+/")
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ape_pat", type="string", length=30, nullable=true)
     * @Assert\NotBlank
     * @Assert\Regex("/[a-zA-Z ]+/")
     */
    private $apePat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ape_mat", type="string", length=30, nullable=true)
     * @Assert\NotBlank
     * @Assert\Regex("/[a-zA-Z ]+/")
     */
    private $apeMat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pass", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    private $pass;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * @Assert\Email(
     *      message = "El email '{{ value }}' no es valido",
     *      mode = "strict" 
     * )
     */
    private $email; //PONER LA RESTRICCION PARA QUE SOLO ACEPTE EMAIL TERMINADOS EN @alumno.ipn.mx o @alumnoguinda.ipn.mx o @[a-zA-Z0-9].ipn.mx

    /**
     * @var string|null
     *
     * @ORM\Column(name="cel", type="string", length=10, nullable=true)
     */
    private $cel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="estudios", type="text", length=65535, nullable=true)
     */
    private $estudios;

    /**
     * @var string|null
     *
     * @ORM\Column(name="acadmy", type="string", length=255, nullable=true)
     */
    private $acadmy;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="disponible", type="boolean", nullable=true)
     */
    private $disponible;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lugar_at", type="string", length=255, nullable=true)
     */
    private $lugarAt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="proyectos_history", type="text", length=65535, nullable=true)
     */
    private $proyectosHistory;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="dt_visibles", type="boolean", nullable=true)
     */
    private $dtVisibles;

    /**
     * @var string|null
     *
     * @ORM\Column(name="foto", type="string", length=255, nullable=true)
     */
    private $foto;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_creado", type="datetime", nullable=true)
     */
    private $fechaCreado;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rol", type="string", length=255, nullable=true)
     */
    private $rol;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Proyecto", mappedBy="usuario")
     */
    private $proyectos; 

    public function __construct(){
        $this -> proyectos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBolMat(): ?string
    {
        return $this->bolMat;
    }

    public function setBolMat(?string $bolMat): self
    {
        $this->bolMat = $bolMat;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApePat(): ?string
    {
        return $this->apePat;
    }

    public function setApePat(?string $apePat): self
    {
        $this->apePat = $apePat;

        return $this;
    }

    public function getApeMat(): ?string
    {
        return $this->apeMat;
    }

    public function setApeMat(?string $apeMat): self
    {
        $this->apeMat = $apeMat;

        return $this;
    }

    public function getPass(): ?string
    {
        return $this->pass;
    }

    public function setPass(?string $pass): self
    {
        $this->pass = $pass;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCel(): ?string
    {
        return $this->cel;
    }

    public function setCel(?string $cel): self
    {
        $this->cel = $cel;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getEstudios(): ?string
    {
        return $this->estudios;
    }

    public function setEstudios(?string $estudios): self
    {
        $this->estudios = $estudios;

        return $this;
    }

    public function getAcadmy(): ?string
    {
        return $this->acadmy;
    }

    public function setAcadmy(?string $acadmy): self
    {
        $this->acadmy = $acadmy;

        return $this;
    }

    public function getDisponible(): ?bool
    {
        return $this->disponible;
    }

    public function setDisponible(?bool $disponible): self
    {
        $this->disponible = $disponible;

        return $this;
    }

    public function getLugarAt(): ?string
    {
        return $this->lugarAt;
    }

    public function setLugarAt(?string $lugarAt): self
    {
        $this->lugarAt = $lugarAt;

        return $this;
    }

    public function getProyectosHistory(): ?string
    {
        return $this->proyectosHistory;
    }

    public function setProyectosHistory(?string $proyectosHistory): self
    {
        $this->proyectosHistory = $proyectosHistory;

        return $this;
    }

    public function getDtVisibles(): ?bool
    {
        return $this->dtVisibles;
    }

    public function setDtVisibles(?bool $dtVisibles): self
    {
        $this->dtVisibles = $dtVisibles;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function getFechaCreado()
    {
        return $this->fechaCreado;
    }

    public function setFechaCreado($fechaCreado): self
    {
        $this->fechaCreado = $fechaCreado;

        return $this;
    }

    public function getRol(): ?string
    {
        return $this->rol;
    }

    public function setRol(?string $rol): self
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * @return Collection|Proyectos[]
     */
    public function getProyectos(): Collection
    {
        return $this->proyectos; 
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->pass;
    }

    public function getSalt()
    {
        return null;
    }

    public function getRoles()
    {
        //$rol = $this->rol;
        // guarantee every user at least has ROLE_USER
        //$rol[] = 'ROLE_USER';

        //return array($rol);
        //return array('ROLE_USER');
        return array($this -> getRol());
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

}
