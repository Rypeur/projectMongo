<?php

namespace App\Form;


use App\Document\Type;
use App\Document\Editor;
use App\Document\Developer;
use App\Document\Platform;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom du produit',])
            ->add('editor', EntityType::class, ['class'=>Editor::class,
            'choice_label'=>'name',
            'multiple'=>true,
            'expanded'=>true,])
            ->add('developer', EntityType::class, ['class'=>Developer::class,
            'choice_label'=>'name',
            'multiple'=>true,
            'expanded'=>true,])
            ->add('platforms', EntityType::class, ['class'=>Platform::class,
            'choice_label'=>'name',
            'multiple'=>true,
            'expanded'=>true,])
            ->add('types',EntityType::class,['class'=>Type::class,
                'choice_label'=>'name',
                'multiple'=>true,
                'expanded'=>true,])
            ->add('release_date', DateType::class, ['widget' => 'choice',]);
    }

}