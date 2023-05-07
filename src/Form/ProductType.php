<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, [
                'label' => 'name'
            ])
            ->add('description',TextType::class, [
                'label' => 'description'
            ])
            ->add('price',NumberType::class, [
                'label' => 'price'
            ])
            ->add('enabled',IntegerType::class, [
                'label' => 'enabled'])

            ->add('slug',TextType::class, [
                'label' => 'slug'])

            ->add('created_at',DateType::class,[
                'label' => 'created at',
                'widget' => 'single_text',])

            ->add('updated_at',DateType::class,[
                'label' => 'updated at',
                'widget' => 'single_text',])

            ->add('brand',TextType::class, [
                'label' => 'brand'])

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
