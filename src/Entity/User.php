<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

// La classe mere userInterface oblige sa classe fille a avoir certaines méthodes supplémentaires 
// que l'on peut retrouver dans la doc : getPassword(), getSalt() and eraseCredentials() que l'on peut retrouver
// sur le net dans la doc : https://symfonycasts.com/screencast/symfony3-security/user-interface-methods


/**
* @ORM\Entity()
* @ORM\Table(name="user")
* */
class User implements UserInterface 
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
    public $username;

   /**
    * @ORM\Column(type="integer")
    */
    public $age;

    /**
    * @ORM\Column(type="string")
    */
    public $email;

    /**
    * @ORM\Column(type="string")
    */
    private $password;

    /**
    * @ORM\Column(type="array")
    */
    public $roles;


    // Des que l'on crée une entité utilisateur, on lui assigne un role user par défault
	public function __construct()
    {
        $this->roles = array('ROLE_USER');
    }


    // Lecture : Explication des relations entre entités dans Doctrine : 
    // /**
    // * @ORM\Column(type="text")
    // */
    // protected $wording;

    // public function __toString()
    // {
    //     $format = "Question (id: %s, wording: %s)\n";
    //     return sprintf($format, $this->id, $this->wording);
    // }


	public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getAge()
    {
    return $this->age;
    }
    public function setAge($age)
    {
        $this->age = $age;
    }

	public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

	public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

 
    // Implements
    // CETTE FONCTION VA NOUS PERMETTRE DE RETOURNER LE ROLE DE L'UTILISATEUR
    
	public function getRoles()
    {
        return $this->roles;
    }

	
    public function getSalt()
    {
        // leaving blank - I don't need/have a password!
    }

    // Fonction oublier le mot de passe / se souvenir
    public function eraseCredentials()
    {
        // leaving blank - I don't need/have a password!
    }



}?>