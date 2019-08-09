<?php

namespace App\Form;

use App\Entity\Despesa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DespesaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descricao', TextType::class, [
                'label' => 'Descricao',
                'attr' => [
                    'placeholder' => 'Descrição da despesa',
                    'class' => 'form-control input-descricao',
                    'id' => 'inputDescricao'
                ]])
            ->add('valor', NumberType::class, [
                'label' => 'Valor',
                'attr' => [
                    'placeholder' => 'Valor da despesa',
                    'class' => 'form-control input-valor',
                    'id' => 'inputValor'
                ]])
            ->add('data', DateType::class, [
                'label' => 'Data',
                'attr' => [
                    'class' => 'form-control input-data',
                    'id' => 'inputData'
                ]]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Despesa::class
        ]);
    }
}