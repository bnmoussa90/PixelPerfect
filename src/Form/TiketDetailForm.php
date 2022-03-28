<?php

// src/Form/Type/TaskType.php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TiketDetailForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('reponse', TextareaType::class, array(
                'label' => 'reponse',
                'attr' => array('class' => 'form-control'),

            ))
            ->add('save', SubmitType::class, array(
                'label' => 'save',
                'attr' => array('class' => 'btn btn-primary'),

            ));
    }
}