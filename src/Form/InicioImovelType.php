<?php

namespace App\Form;

use App\Entity\Imovel;
use App\Entity\TipoImovel;
use App\Entity\Cidade;
use App\Entity\ImobiliariaAtuacao;
use App\Repository\CidadeRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class InicioImovelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipoAnuncio', ChoiceType::class, [
                'required' => true,
                'expanded' => false,
                'multiple' => false,
                'choices'  => [
                    'Alugar' => 'alugar',
                    'Comprar' => 'vender'
                ],
                'data' => 'alugar',
                'attr' => [
                    'class' => 'form-control',
                    'aria-label' => 'Escolha entre alugar e comprar'
                ]
            ])

            ->add('fkTipoImovelId', EntityType::class, [
                'class' => TipoImovel::class,
                'choice_label' => 'nome',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'aria-label' => 'Escolha o tipo de imóvel'
                ]
            ])

            ->add('fkCidadeId', EntityType::class, [
                'class' => Cidade::class,
                'choice_label' => 'nome',
                'required' => false,
                'query_builder' => function (CidadeRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->innerJoin(ImobiliariaAtuacao::class, 'i', 'WITH', 'c.id = i.fkCidadeId')
                        ->orderBy('c.nome', 'ASC');
                },
                'attr' => [
                    'class' => 'form-control',
                    'aria-label' => 'Escolha a cidade'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Imovel::class,
        ]);
    }
}
