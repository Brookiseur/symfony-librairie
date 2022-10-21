<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Author;
use App\Entity\BookCategory;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isActive', CheckboxType::class, ["label"=>"Livre Visible ?", "row_attr"=>["class"=>"form-switch"], "required"=>false])
            ->add('titre', TextType::class, ["label"=>"Titre", "required"=>true])
            ->add('description', CKEditorType::class, ["label"=>"Description", "required"=>false])
            ->add('imageFile', FileType::class, ["label"=>"Image", "required"=>false])
            ->add('author', EntityType::class, ["class"=>Author::class, "label"=>"Auteur", "required"=>true])
            ->add('bookCategory', EntityType::class, ["label"=>"Catégorie", "class"=>BookCategory::class, "required"=>true])
            ->remove('updatedAt')
            ->remove('slug')
            ->remove('imageName')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
