<?php

namespace App\Form;

use App\Entity\Usages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UsagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, [
                'label' => false,
                'attr'=>array(
                    'placeholder' => 'Usage',
                    'autofocus' => true, 
                ), 
                
                ])
            ->add('description', TextType::class, [
                'label' => false,
                'attr'=>array(
                    'placeholder' => 'Description',
                    'autofocus' => true, )]
                )
            ->add('img', TextType::class, [
                    'label' => false,
                    'attr'=>array(
                        'placeholder' => 'Image',
                        'autofocus' => true, )]
                    );
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usages::class,
        ]);
    }
}
