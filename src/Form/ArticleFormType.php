<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        # https://symfony.com/doc/current/reference/forms/types.html
        $builder->add('title', TextType::class, [
            'help' => 'Enter title of the post'
        ])
            ->add('content')
            ->add('publishedAt', DateType::class, [
                'help' => 'Select date to be published'
            ])
            ->add('author', EntityType::class, [
                'class' => User::class,
                'choice_label' => function(User $user){
                    return sprintf('(%d) %s', $user->getId(), $user->getEmail());
                },
                'placeholder' => 'Choose an Author'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class
        ]);
    }
}