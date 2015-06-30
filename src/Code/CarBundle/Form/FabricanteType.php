<?php
namespace Code\CarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

class FabricanteType  extends AbstractType{
   
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nome')
               // ->add('carros')
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(
            array('data_class'=> 'Code\CarBundle\Entity\Fabricante')
                );
    }

    public function getName() {
        return "code_carbundle_fabricantetype";
    }

}
