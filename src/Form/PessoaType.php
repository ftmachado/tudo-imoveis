<?php

namespace App\Form;

use App\Entity\Pessoa;
use App\Entity\Estado;
use App\Entity\Cidade;
use App\Entity\Bairro;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PessoaType extends AbstractType
{
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
            
            ->remove('roles')
            ->remove('password')
            ->remove('usuario')
            // ->remove('administrador')
            // ->remove('cliente')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pessoa::class,
        ]);
    }
}
