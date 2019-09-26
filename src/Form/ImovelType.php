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
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityManagerInterface;

class ImovelType extends AbstractType
{
    /**
     * Criando um combo select dependente com Symfony
     * Fonte: https://ourcodeworld.com/articles/read/652/how-to-create-a-dependent-select-dependent-dropdown-in-symfony-3
     */
    private $em;

    // 1. Add entity manager
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

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
                ],
                'attr' => [
                    'class' => 'form-control'
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

            // ->add('fkCidadeId', EntityType::class, [
            //     'class' => Cidade::class,
            //     'choice_label' => 'nome',
            //     'attr' => [
            //         'class' => 'form-control',
            //     ]
            // ])

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

        // 3. Add 2 evet listeners
        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
        $builder->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));

    }

    // 4. Add the province element
    protected function addElements(FormInterface $form, Estado $e = null)
    {

        $cidades = [];

        //Se houver um estado armazenado carrega as cidades corretas
        if ($e) {
            $cidades = $this->em->getRepository(Cidade::class)->findBy(['fkEstadoId' => $e->getId()]);
        }

        $form->add('fkCidadeId', EntityType::class, [
            'class' => Cidade::class,
            'choices' => $cidades,
            'required' => false,
            'choice_label' => 'nome',
            'placeholder' => 'Selecione um estado',
            'attr' => [
                'class' => 'form-control'
            ]
        ]);
        
    }

    public function onPreSubmit(FormEvent $event)
    {

        $form = $event->getForm();
        $data = $event->getData();
        
        if (isset($data['fkCidadeId'])) {
            $data['fkCidadeId'] = $this->em->getRepository(Cidade::class)->findOneById($data['fkCidadeId']);
        }
        
    }

    public function onPreSetData(FormEvent $event) 
    {

        $entity = $event->getData();
        $form = $event->getForm();
        
        $estado = $entity->getFkEstadoId() ? $entity->getFkEstadoId() : null;
        
        $this->addElements($form, $estado);

    } 

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Imovel::class,
        ]);
    }
}
