<?php

namespace App\Form;

use App\Entity\Pessoa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class TrocarSenhaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'first_options' => [
                    'label' => 'Senha',
                    'attr' => [
                        'class' => 'form-control',
                        'minlength' => 6,
                        'maxlength' => 20,
                        'autocomplete' => 'off',
                        'autocorrect' => "off",
                        'autocapitalize' => "none",
                        'spellcheck' => "false"
                    ],
                ],
                'second_options' => [
                    'label' => 'Repita a senha',
                    'attr' => [
                        'class' => 'form-control',
                        'minlength' => 6,
                        'maxlength' => 20,
                        'autocomplete' => 'off',
                        'autocorrect' => "off",
                        'autocapitalize' => "none",
                        'spellcheck' => "false"
                    ],
                ]
            ])
    
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pessoa::class,
        ]);
    }
}
