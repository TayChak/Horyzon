<?php

namespace App\Form;

use App\Entity\Article;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'title', 
                TextType::class, 
                $this->getConfiguration('Titre', 'Titre de l\'article')
            )
            ->add(
                'picture', 
                UrlType::class, 
                $this->getConfiguration('URL Image', 'URL de l\'image')
            )
            ->add(
                'description', 
                TextType::class, 
                $this->getConfiguration('Description', 'Détails sur l\'article')
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
