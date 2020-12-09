<?php 
// src/Form/ContactType.php
namespace App\Form;

use App\Entity\Contact; // On récupère notre objet Contact
use Symfony\Component\Form\AbstractType; // Initialise le champ par défaut
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver; // Trouve le champ HTML associé au type Doctrine
use Symfony\Component\Form\Extension\Core\Type\TextType; // Champ "TextType", penser à ajouter chaque champ utilisé

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('age', IntegerType::class)
            ->add('numero') //Par défaut si on ne met rien c'est un champ TextType

        ;
    }
    
    public function configureOptions(OptionsResolver $resolver) // Fonction qui génère le bon type de champ HTML en fonction du type Doctrine
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
?>