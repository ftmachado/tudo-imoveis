<?php

namespace App\Form;

use App\Entity\ImobiliariaAtuacao;
use App\Entity\Estado;
use App\Entity\Cidade;
use App\Entity\Imobiliaria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ImobiliariaAtuacaoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fkImobiliariaId', EntityType::class, [
                'class' => Imobiliaria::class,
                'choice_label' => 'nomeFantasia',
            ])
            
            ->add('fkEstadoId', EntityType::class, [
                'class' => Estado::class,
                'choice_label' => 'nome',
            ])

            ->add('fkCidadeId', EntityType::class, [
                'class' => Cidade::class,
                'choice_label' => 'nome',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ImobiliariaAtuacao::class,
        ]);
    }
}
