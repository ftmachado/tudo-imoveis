<?php

namespace App\Form;

use App\Entity\Imovel;
use App\Entity\TipoImovel;
use App\Entity\Cidade;
use App\Entity\Bairro;
use App\Entity\ImobiliariaAtuacao;
use App\Repository\CidadeRepository;
use App\Repository\BairroRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BuscaImovelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fkTipoImovelId', EntityType::class, [
                'class' => TipoImovel::class,
                'choice_label' => 'nome',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
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
                    'class' => 'form-control'
                ]
            ])

            ->add('fkBairroId', EntityType::class, [
                'class' => Bairro::class,
                'choice_label' => 'nome',
                'required' => false,
                'query_builder' => function (BairroRepository $er) use ($options) {

                    if ($options['data']->getFkBairroId() === null ) {
                        return $er->createQueryBuilder('b')
                            ->setMaxResults(0);
                    }

                },
                'placeholder' => 'Selecione uma cidade',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('garagem', ChoiceType::class, [
                'required' => false,
                'expanded' => true,
                'multiple' => false,
                'choices'  => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3+' => '3'
                ],
                'attr' => [
                    'class' => 'magic-radio'
                ]
            ])

            ->add('quarto', ChoiceType::class, [
                'required' => false,
                'expanded' => true,
                'multiple' => false,
                'choices'  => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4+' => '4'
                ],
                'attr' => [
                    'class' => 'magic-radio'
                ]
            ])

            ->add('banheiro', ChoiceType::class, [
                'required' => false,
                'expanded' => true,
                'multiple' => false,
                'choices'  => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4+' => '4'
                ],
                'attr' => [
                    'class' => 'magic-radio'
                ]
            ])

            ->add('valorImobiliaria', RepeatedType::class, [
                'type' => TextType::class,
                'required' => false,
                'first_options'  => [ 
                    'attr' => [
                        'placeholder' => 'De',
                        'class' => 'form-control',
                    ] 
                ],
                'second_options' => [ 
                    'attr' => [
                        'placeholder' => 'Até',
                        'class' => 'form-control',
                    ]
                ],
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
