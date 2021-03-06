<?php

namespace App\Form;

use App\Entity\Pessoa;
use App\Entity\Estado;
use App\Entity\Cidade;
use App\Entity\Bairro;
use App\Repository\BairroRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityManagerInterface;

class PessoaType extends AbstractType
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
            ->add('email', EmailType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]  
            ])
            
            ->add('cpf', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'maxlenght' => 11
                ]
            ])
            
            ->add('rg', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'maxlenght' => 14
                ]
            ])
            
            ->add('nome', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            
            ->add('telefonePrincipal', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            
            ->add('telefoneSecundario', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
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
            
            ->add('fkEstadoId', EntityType::class, [
                'class' => Estado::class,
                'choice_label' => 'nome',
                'placeholder' => 'Selecione...',
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
                'query_builder' => function (BairroRepository $er) use ($options) {

                    if ($options['data']->getFkCidadeId()) {
                        
                        return $er->createQueryBuilder('b')
                            ->where('b.fkCidadeId = :cidade')
                            ->setParameter('cidade', $options['data']->getFkCidadeId()->getId())
                            ->orderBy('b.nome', 'ASC');

                    } else {
                        return $er->createQueryBuilder('b')
                            ->where('b.id = 0');
                    }
                    
                },
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            
            ->remove('roles')
            ->remove('password')
            ->remove('usuario')
            // ->remove('administrador')
            // ->remove('cliente')
        ;

        // 3. Add 2 evet listeners
        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));

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
            'required' => true,
            'choice_label' => 'nome',
            'attr' => [
                'class' => 'form-control'
            ]
        ]);
        
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
            'data_class' => Pessoa::class,
        ]);
    }
}
