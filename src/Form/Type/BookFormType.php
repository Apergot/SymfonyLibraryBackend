<?php

namespace App\Form\Type;

use App\Entity\Book;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder -> add('title', TextType::class);
    }

    // let us associate the class which references the form.
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver -> setDefaults([
            'data_class' => Book::class
        ]);
    }

    //In order to avoid request format using {"book_form: {...}"} next two methods
    public function getBlockPrefix()
    {
        return '';
    }

    public function getName()
    {
        return '';
    }
}