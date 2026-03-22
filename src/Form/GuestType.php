<?php

namespace App\Form;

use App\Entity\Guests;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class GuestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('guest_name', TextType::class, [
                'label'      => false,
                'label_html' => true,
                'attr'       => [
                    'class' => 'form-control form-control-shakespeare',
                ],
            ])
            ->add('guest_gender_code', ChoiceType::class, [
                'label'      => false,
                'label_html' => true,
                'choices'  => [
                    '' => 0,
                    '男性を演じる' => 0,
                    '女性を演じる' => 1,
                    'どちらでもよい' => 2,
                ],
                'attr'       => [
                    'class' => 'form-control form-control-shakespeare',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label'      => '物語を始める',
                'label_html' => true,
                'attr'       => [
                    'class' => 'btn btn-gold btn-lg px-5 py-2 text-uppercase small',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Guests::class,
        ]);
    }
}