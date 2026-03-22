<?php

namespace App\Form;

use App\Entity\Decks;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DeckType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void{
        $builder
            ->add('selectedDeck', EntityType::class, [
                'class' => Decks::class,
                'choices' => $options['decks'],
                'choice_label' => 'deck_name', 
                'expanded' => true,  // これを true にするとラジオボタン
                'multiple' => false, // 単一選択
                'choice_attr' => function (Decks $deck) {
                    return [
                        'deck-description' => $deck->getDeckDescription()
                    ];
                }
            ])
            ->add('submit', SubmitType::class, [
                'label'      => 'NEXT',
                'label_html' => true,
                'attr'       => [
                    'class' => 'btn btn-gold btn-lg px-5 py-2 text-uppercase small',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void{
        $resolver->setDefaults([
            'decks' => [],
        ]);
    }
}