<?php

namespace App\Form;

use App\Entity\Imovel;
use App\Entity\TipoImovel;
use App\Entity\Pessoa;
use App\Entity\Estado;
use App\Entity\Cidade;
use App\Entity\Bairro;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ImovelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('tipoAnuncio', ChoiceType::class, [
                'expanded' => true,
                'multiple' => false,
                'choices'  => [
                    'Alugar' => 'alugar',
                    'Vender' => 'vender',
                ],
                'attr' => [
                    'class' => 'magic-radio'
                ]
            ])

            ->add('endereco', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('numero', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('cep', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            
            ->add('complemento', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('areaTotal', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('areaUtil', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('garagem', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('quarto', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('banheiro', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('exposicaoSolar', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('posicaoPredio', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('status', ChoiceType::class, [
                'expanded' => false,
                'multiple' => false,
                'choices'  => [
                    'Disponível' => 'disponivel',
                    'Vendido' => 'vendido',
                    'Alugado' => 'alugado',
                    'Cancelado' => 'cancelado',
                ]
            ])

            // ->add('statusData')
            ->add('descricao', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('valorProprietario', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('valorCondominio', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('valorIptu', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('valorImobiliaria', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('fkTipoImovelId', EntityType::class, [
                'class' => TipoImovel::class,
                'choice_label' => 'nome',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('fkEstadoId', EntityType::class, [
                'class' => Estado::class,
                'choice_label' => 'nome',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('fkCidadeId', EntityType::class, [
                'class' => Cidade::class,
                'choice_label' => 'nome',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('fkBairroId', EntityType::class, [
                'class' => Bairro::class,
                'choice_label' => 'nome',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('fkProprietarioId', EntityType::class, [
                'class' => Pessoa::class,
                'choice_label' => 'nome',
                'attr' => [
                    'class' => 'form-control',
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
