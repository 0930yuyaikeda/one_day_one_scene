<?php

namespace App\Form;

use App\FormModel\QuestionFormModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class QuestionType extends AbstractType
{
    /**
    * @param FormBuilderInterface $builder
    * @param array                $options
    *
    * @return void
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('question1', HiddenType::class, [
                'required'   => false,
            ])

            ->add('question2', HiddenType::class, [
                'required'   => false,
            ])

            ->add('question3', HiddenType::class, [
                'required'   => false,
            ])

            ->add('question4', HiddenType::class, [
                'required'   => false,
            ])

            ->add('question5', HiddenType::class, [
                'required'   => false,
            ])

            ->add('question6', HiddenType::class, [
                'required'   => false,
            ])

            ->add('question7', HiddenType::class, [
                'required'   => false,
            ])

            ->add('question8', HiddenType::class, [
                'required'   => false,
            ])

            ->add('question9', HiddenType::class, [
                'required'   => false,
            ])

            ->add('question10', HiddenType::class, [
                'required'   => false,
            ])

            ->add('question11', HiddenType::class, [
                'required'   => false,
            ])

            ->add('question12', HiddenType::class, [
                'required'   => false,
            ])

            ->add('question13', HiddenType::class, [
                'required'   => false,
            ])

            ->add('question14', HiddenType::class, [
                'required'   => false,
            ])

            ->add('question15', HiddenType::class, [
                'required'   => false,
            ])

            ->add('submit', SubmitType::class, [
                'label'      => '結果を見る',
                'label_html' => true,
                'attr'       => [
                    'class' => 'btn btn-outline-warning btn-lg px-5 py-3 text-uppercase',
                ],
            ]);
    }

    /**
    * @param OptionsResolver $resolver
    *
    * @return void
    */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(array(
            'data_class' => QuestionFormModel::class,
        ));
    }
}


