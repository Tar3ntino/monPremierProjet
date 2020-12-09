<?php
// src/Controller/IndexController.php

namespace App\Controller;

// NOS DEPENDANCES : 

use App\Entity\User;
use Twig\Environment;
use App\Form\UserType;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
* @Route("/")
*/
class IndexController extends AbstractController
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

/**
* @Route("/", name="index")
*/
	public function index(Environment $twig, Request $request)
	{
		// On affiche notre template (plus tard ou pourra lui passer des variables et autres)
		return $this->render('layout.html.twig');
		
	}

/**
* @Route("/premiere", name="premiere")
*/
public function premiere(Environment $twig, Request $request)
{
    // On affiche notre template (plus tard ou pourra lui passer des variables et autres)
    return $this->render('premiere.html.twig');
    
}

/**
* @Route("/variable", name="variable")
*/
public function variable(Environment $twig, Request $request)
{
    $name = "Quentin";
    $age = random_int(15, 100);
    $telephone = "0705060403";
    $listePrenom = ['Quentin', 'Tarantino', 'QG'];

    return $this->render('variable.html.twig', ['name' => $name, 'age' => $age, 'telephone' => $telephone, 'listePrenom' => $listePrenom]);
    
}

/**
 * @Route("/contact/new")
 */
public function new(Request $request)
{
    $contact = new Contact();
    $contact->setNom(''); // La valeur entre guillemet est la valeur par défaut
    $contact->setNumero('0705060403');

    $form = $this->createForm(ContactType::class, $contact);

	$form->handleRequest($request);

	if ($form->isSubmitted()) { 
		$em = $this->getDoctrine()->getManager();
		$em->persist($contact);
		$em->flush();
	}

    return $this->render('ajoutContact.html.twig', array(
        'form' => $form->createView(),
    ));
}

/**
 * @Route("/user/new")
 */
public function newUser(Request $request)
{
    $user = new User();
    // $user->setUsername(''); La valeur entre guillemet est la valeur par défaut
    // $user->setAge(''); CES LIGNES NE SERVENT A RIEN CAR C'EST L'UTILISATEUR QUI VA SAISIR SES PROPRES DONNEES
    // $user->setEmail(''); CES LIGNES NE SERVENT A RIEN CAR C'EST L'UTILISATEUR QUI VA SAISIR SES PROPRES DONNEES
    // $user->setPassword(''); CES LIGNES NE SERVENT A RIEN CAR C'EST L'UTILISATEUR QUI VA SAISIR SES PROPRES DONNEES
    // $user->setRole('ROLE_USER'); // Les gens qui vont s'inscrire par défaut seront de simple USER (utilisateur). 
    // Si jamais on veut faire un compte ADMIn, on le fera direct dans PHP MY ADMIN

    $form = $this->createForm(UserType::class, $user);

	$form->handleRequest($request);

	if ($form->isSubmitted()) {
        $mdp = $user->getPassword();
        $password = $this->encoder->encodePassword($user, $mdp); // on crypte le password que l'on va chercher dans le fichier
        $user->setPassword($password); // on enregistre le password qui a été crypté

        // On envoie notre objet avec notre mot de passe crypté et on l'enregistre
		$em = $this->getDoctrine()->getManager();
		$em->persist($user);
		$em->flush(); 
	}

    return $this->render('ajoutUser.html.twig', array(
        'form' => $form->createView(),
    ));
}

}
?>