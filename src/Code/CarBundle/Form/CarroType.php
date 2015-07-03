<?php
namespace Code\CarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

class CarroType  extends AbstractType{
   
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('modelo')
                ->add('ano')
                ->add('cor')
                ->add('fabricante')
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(
            array('data_class'=> 'Code\CarBundle\Entity\Carro')
                );
    }

    public function getName() {
        return "code_carbundle_carrotype";
    }

}
