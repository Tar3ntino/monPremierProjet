<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity()
* @ORM\Table(name="contact")
* */
class Contact
{
    /**
    * @ORM\Id()
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    public $id;

    /**
    * @ORM\Column(type="string")
    */
    public $nom;

    /**
    * @ORM\Column(type="string")
    */
    public $numero;

   /**
    * @ORM\Column(type="integer")
    */
    public $age;

	
	public function getNom()
    {
        return $this->nom;
    }
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

	public function getNumero()
    {
        return $this->numero;
    }
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function getAge()
    {
    return $this->age;
    }
    public function setAge($age)
    {
        $this->age = $age;
    }




}?>