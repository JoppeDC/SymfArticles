<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('title', TextType::class, [
            'required' => true,
            'constraints' => [new NotBlank()],
            'attr' => ['class' => 'form-control'],
        ]);

        $builder->add('body', TextareaType::class, [
            'required' => true,
            'constraints' => [new NotBlank()],
            'attr' => ['class' => 'form-control'],
        ]);

        $builder->add('save', SubmitType::class, [
            'label' => 'Create',
            'attr' => ['class' => 'btn btn-primary mt-3'],
        ]);
    }
}
