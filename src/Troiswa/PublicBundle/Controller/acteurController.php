<?php

namespace Troiswa\PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Troiswa\PublicBundle\Entity\acteur;
//on tape request symfony2 use pour avoir use
use Symfony\Component\HttpFoundation\Request;
use Troiswa\PublicBundle\Form\acteurType;


class acteurController extends Controller

{
 
public function acteursAction()
    
    {
    $em=$this->getDoctrine()->getManager();
    $acteurs=$em->getRepository('TroiswaPublicBundle:acteur')
    ->findAll();
    return $this->render('TroiswaPublicBundle:acteur:acteurs.html.twig',
    array('acteurs'=>$acteurs));


    }


public function acteurAction($number)

    {
    $em=$this->getDoctrine()->getManager();
    $acteur=$em->getRepository('TroiswaPublicBundle:acteur')
    ->find($number);
      
    return $this->render('TroiswaPublicBundle:acteur:acteur.html.twig', 
    array('acteur'=>$acteur));
      
      
    }

public function admin_acteur_ajouterAction(Request $request)

    {
    
    //creer le formulaire liée a la classe acteur
    $acteur = new acteur();
    
    $formActeur=$this->createForm(new acteurType(), $acteur)
    //1 er parametre propriete et 2 type du champ et on peut avoir un troisieme parametre qui correspond toujour à un tableau 
    
    ->add('ajouter','submit');
    
   
    
    //ON RÉCUPERE LA REQUETTE AVEC SYMFONY
    
    if("POST" === $request->getMethod())

    {
        // die('POST');
        
        //recuperer les info passer dans le formulaire
        //$formActeur->bind($request);
         $formActeur->handleRequest($request);
        //fonction native qui renvoi true /false si formulaire valide
        if($formActeur->isValid())
        
        {
            //on appel la fonction upload()
            $acteur->upload();
            $em=$this->getDoctrine()->getManager();
            //surveille l'objet $acteur
            $em->persist($acteur);
            //sauvgarder dans la base de donnée
            $em->flush();

            //pour afficher un message flach à l'utilisateur
            $session=$request->getSession();
            //fonction natve propre à symfony
            $session->getFlashBag()

            ->add('info', 'Votre acteur a été ajouté');

        

        //redirection sur la meme page on copie l'identifiant du routing
        return $this->redirect($this->generateUrl('troiswa_public_admin_acteur_ajouter'));

        }


    }

    return $this->render('TroiswaPublicBundle:acteur:ajouter.html.twig',
    array('formActeur'=>$formActeur->createView()));
      
      
    }

public function  admin_acteur_updateAction($number, Request $request)

    {
    
    $em=$this->getDoctrine()->getManager();
    
    $acteur=$em->getRepository('TroiswaPublicBundle:acteur')
    ->find($number);
    
    $formActeurprerempli=$this->createFormBuilder($acteur)
    
    ->add('prenom','text')
    ->add('nom')
    ->add('dateNaissance')
    ->add('sexe')
    ->add('nationalite')
    ->add('biographie')
    ->add('ajouter','submit')
    
    ->getForm();
    
    if("POST" === $request->getMethod())

    {
        // die('POST');
        
        
        $formActeurprerempli->bind($request);
        
        
        if($formActeurprerempli->isValid())
        
        {
            $em=$this->getDoctrine()->getManager();
            
            $em->persist($acteur);
            
            $em->flush();

            
            $session=$request->getSession();
            
            $session->getFlashBag()

            ->add('info', 'Votre fiche acteur a été mise à jour');

        

        
        return $this->redirect($this->generateUrl('troiswa_public_admin_acteur_update',
            //je veux l'id de cette acteur 
            array('number'=>$acteur->getId())));

        }


    }
    
    

    return $this->render('TroiswaPublicBundle:acteur:update.html.twig',
    array('formActeurprerempli'=>$formActeurprerempli->createView()));
      
      
    }



}