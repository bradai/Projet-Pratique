<?php


namespace App\Form;

use App\Entity\Facture;
use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation', TextType::class, [
                'label' => 'Désignation',
                'attr' => [
                    'maxlength' => 255,
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
            ])

            ->add('articles', EntityType::class, [
                'class' => Article::class,
                'choice_label' => 'nom',
                'choice_attr' => function (Article $article) {
                    return ['data-prix' => $article->getPrix()];
                },
                'multiple' => true,
                'expanded' => false,
            ])

        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}