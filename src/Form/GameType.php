<?php

namespace App\Form;


use App\Document\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom du produit',])
            ->add('editor   ', TextType   ::class, ['label' => 'Déscription du produit',])
            ->add('picture', UrlType::class, [
                'label' => 'Lien de l\'Image'])
            ->add('price', IntegerType::class, ['label' => 'Prix du produit',])
            ->add('editor', TextType::class, ['label' => 'Marque du produit',])
            ->add('type',EntityType::class,['class'=>Type::class,
                'choice_label'=>'name',
                'multiple'=>true,
                'expanded'=>true,]);
    }

}