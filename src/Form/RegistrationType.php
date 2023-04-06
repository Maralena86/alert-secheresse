<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\CategorieUtilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'attr'=>array(
                    'placeholder' => 'Prenom',
                    'autofocus' => true, 
                ), 
                             
                'required' => true
            ])
           
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Email'
                ),               
                'required' => true
            ]) 
            ->add('category_user', EntityType::class, [
                'class' => CategorieUtilisateur::class,
                'choice_label' => 'name',
                'label' =>"Selectionez votre situation",
                'multiple'=> true,
                'expanded'=> true,
                'required' => false
            ])          
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'constraints' =>[
                    new Regex('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[#?!@$%^&*-]).{8,}$/', "Il faut un mot de pase de 8 caractères avec 1 majuscule, 1 miniscule et 1 caractère spécial (!*#)")                    
                    ],
                'first_options' => [
                    'label' => false,

                    'attr' => array(
                        'placeholder' => 'Votre mot de passe'
                    ),
                ],
                'second_options' => [
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'Repetez votre mot de passe'
                    )
                ]
            ])
            ->add('send', SubmitType::class, [
                'label' => "S'inscrire",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
