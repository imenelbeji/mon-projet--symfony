<?php

namespace Troiswa\PublicBundle\Controller;
use Troiswa\PublicBundle\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class categorieController extends Controller
{
 public function categoriesAction()
  {
     
     
      $em=$this->getDoctrine()->getManager();
      $categories=$em->getRepository('TroiswaPublicBundle:Categorie')
      ->findAll();
    
        
        return $this->render('TroiswaPublicBundle:categorie:categories.html.twig',
        array('categories'=>$categories));


    }

} 