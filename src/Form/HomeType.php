<?php

namespace App\Form;

use App\Entity\Home;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class HomeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isActive', CheckboxType::class, ["label"=>"Page active ?", "row_attr"=>["class"=>"form-switch"], "required"=>false])
            ->add('titre', TextType::class, ["help"=>"Le titre de la page", "help_attr"=>["class"=>"text-primary"], "label"=>"Le titre", "required"=>true ])
            ->add('texte', CKEditorType::class, ["label"=>"Le texte", "required"=>true])
            ->add('signature', TextType::class, ["label"=>"La signature", "required"=>true])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Home::class,
        ]);
    }
}
