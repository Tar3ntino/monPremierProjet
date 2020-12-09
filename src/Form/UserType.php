<?php 
// src/Form/ContactType.php
namespace App\Form;

use App\Entity\User; // On récupère notre objet Contact
use Symfony\Component\Form\AbstractType; // Initialise le champ par défaut
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver; // Trouve le champ HTML associé au type Doctrine
use Symfony\Component\Form\Extension\Core\Type\TextType; // Champ "TextType", penser à ajouter chaque champ utilisé

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('age', IntegerType::class)
            ->add('email', TextType::class)
            ->add('password', PasswordType::class)
            // ->add('role', TextType::class) 
            // On ne va pas laisser l'utilisateur créer son rôle, on le mettra par défaut
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver) // Fonction qui génère le bon type de champ HTML en fonction du type Doctrine
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
?>