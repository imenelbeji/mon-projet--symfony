<?php

namespace Troiswa\PublicBundle\Controller;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class MainController extends Controller
{
    public function indexAction()
    {
       $em=$this->getDoctrine()->getManager();
       $allFilmsByCategorie=$em->getRepository('TroiswaPublicBundle:Film')
       ->getNbFilmByCategorie();


       //on fait un chemain jusqua fichier default qui est le dossier dans views 
    	//ensuite nous avons le nom du fichier index.html.twig
        return $this->render('TroiswaPublicBundle:Main:index.html.twig',
           array('allFilmsByCategorie'=>$allFilmsByCategorie));
    
    }

    public function bonjourAction()
    {
       
        return $this->render('TroiswaPublicBundle:Main:bonjour.html.twig');
    
    }

    public function ageAction($number)
    {
       //fonction qui renvoi ddu html
        return $this->render('TroiswaPublicBundle:Main:age.html.twig',
                             array('mon_age'=>$number));
    
    
    }

    /*public function competencesAction()
    {
       $competences=array('php'=>9,'html'=>3,'css'=>7,'js'=>5);
       
       return $this->render('TroiswaPublicBundle:Main:competences.html.twig',
        array('competences'=>$competences));
    
    
    }
    */
    
    public function competencesAction()
    {
       $competences=array('php'=>array('note'=>9,'couleur'=>"#ffec03"),
                          'html'=>array('note'=>5,'couleur'=>"#C0ffff"),
                          'css'=>array('note'=>7,'couleur'=>"#66CC66"),
                          'js'=>array('note'=>8,'couleur'=>"#FF00FF")
                         );
       
       return $this->render('TroiswaPublicBundle:Main:competences.html.twig',
        array('competences'=>$competences));
    
    
    }

     public function contactAction(Request $request)
    
    {


    $formContact=$this->createFormBuilder()
                      ->add('name','text',
                          array(
                            'constraints'=> new Assert\ NotBlank()
                          )
                        )
                      
                      ->add('email',null,
                          array(
                          'constraints'=> array(
                            new Assert\ NotBlank(),
                            new Assert\Email(
                              array('message' => " ceci n'est pas un email valide."
                                )
                              )
                            )
                          )
                        )
                      ->add('phone',null,
                        array(
                         'constraints'=>new Assert\Regex(
                             array(
                              'pattern' => '/^0[1-68]([/-. ]?[0-9]{3})([0-9]){2}$/',
                              'message' => " ceci n'est pas un numero valide."
                            )
                          )
                        )
                      )
                      
                      ->add('message','textarea',
                          
                          array(

                            'constraints'=>array(
                                new Assert\ NotBlank(), 
                                new Assert\ Length(array(
                                  'min'=>"500",
                                  'minMessage' => "votre message doit etre inferieur à 500 caractere."
                                )
                              )
                            )
                          )
                        )
                      ->add('ajouter','submit')
                      ->getForm();
        
         $formContact->handleRequest($request);
       
        if($formContact->isValid())
        
        {
 
          $email=$formContact->get('email')->getData();
          $name=$formContact->get('name')->getData();
          $message=  \Swift_Message::newInstance()
          ->setSubject("Formulaire de contact")
          ->setFrom("$email")
          ->setTo("hs_imen@hotmail.com")
          ->setBody($this->render('TroiswaPublicBundle:Main:contact.html.twig',
            array('name'=>$name)));
          
          $this->get('mailer')->sen('$mail');
  


            $session=$request->getSession();
           
            $session->getFlashBag()

            ->add('info', 'ajouter contact');

        

        
        return $this->redirect($this->generateUrl('troiswa_public_contact'));

        }


    

    return $this->render('TroiswaPublicBundle:Main:contact.html.twig',
      array('formContact'=>$formContact->createView() ));
      
      
    }

    



}
