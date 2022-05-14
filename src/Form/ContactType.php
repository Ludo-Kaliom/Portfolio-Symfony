<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom",
                'required' => true,
                'attr' => [
                    'placeholder' => "Votre nom",
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => "Email",
                'required' => true,
                'attr' => [
                    'placeholder' => "Votre email"
                ]
            ])
            ->add('topic', TextType::class, [
                'label' => "Sujet",
                'required' => true,
                'attr' => [
                    'placeholder' => "Le sujet de votre message"
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => "Message",
                'required' => true,
                'attr' => [
                    'placeholder' => "Expliquez-moi en détail votre projet ou votre demande"
                ]
            ])
            ->add('captcha', CaptchaType::class, [
                'label' => "Code de vérification ",
                'attr' => [
                    'placeholder' => "Entrez le code de vérification"
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
