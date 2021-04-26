<?php

namespace App\Form\Type;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            -> add('title', TextType::class);
    }

    // let us associate the class which references the form.
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver -> setDefaults([
            'data_class' => Book::class
        ]);
    }
}