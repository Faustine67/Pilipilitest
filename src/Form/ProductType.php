<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, [
                'label' => 'name'
            ])
            ->add('description',TextareaType::class, [
                'label' => 'description',
                'attr' => [
                    'rows' => 10
                ]
            ])
            ->add('price',NumberType::class, [
                'label' => 'price'
            ])
            ->remove('enabled',IntegerType::class, [
                'label' => 'enabled'])

            ->remove('slug',TextType::class, [
                'label' => 'slug'])

            ->remove('created_at',DateType::class,[
                'label' => 'created at',
                'widget' => 'single_text',])

            ->remove('updated_at',DateType::class,[
                'label' => 'updated at',
                'widget' => 'single_text',])

            ->add('brand', EntityType::class, [
                    'class' => Brand::class,
                    'choice_label' => 'name',
                ])
                
            ->add('submit', SubmitType::class, [
                'label' => 'Submit'
                ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
