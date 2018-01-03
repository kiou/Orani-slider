<?php

namespace SliderBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use GlobalBundle\Form\Type\LangueType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SliderType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class)
            ->add('langue', LangueType::class)
            ->add('Enregistrer', SubmitType::class, array(
                    'attr' => array('class' => 'form-submit turquoise medium')
                )
            );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SliderBundle\Entity\Slider'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sliderbundle_slider';
    }


}
