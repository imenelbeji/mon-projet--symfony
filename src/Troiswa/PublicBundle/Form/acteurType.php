<?php

namespace Troiswa\PublicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class acteurType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
    
    ->add('prenom','text'//, array('required' => false on enleve la validation html5
        )
    ->add('nom','text', array('required' => false))
    //on rajoute le champ
    ->add('fichier','file')
    /*->add('dateNaissance','date',array(

        'widget' => 'single_text',
        'format' => 'yyyy-MM-dd',

        ))
    //on peut ecrire aussi
    */
    ->add('dateNaissance','date', array(

        'widget' => 'choice',
        'years' => range(Date('Y'),1900)))
    
    
    ->add('sexe','choice', array(
        'choices' => array(
            '0' => 'Féminin', '1' => 'Masculin'),
        'expanded'    => true,
        'data'  => 0,

        ))
    
    ->add('nationalite','text', array('required' => false))
    ->add('biographie','text', array('required' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Troiswa\PublicBundle\Entity\acteur'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'troiswa_publicbundle_acteur';
    }
}
