<?php

namespace Troiswa\PublicBundle\Controller;
use Troiswa\PublicBundle\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Troiswa\PublicBundle\Form\FilmType;

class filmController extends Controller
{
 public function filmsAction()
    {
     
     /*$films=[['id_film'=>0,'titre'=>"The Holiday",'synopsis'=>"Une Américaine (Amanda) et une Anglaise (Iris), toutes deux déçues des hommes, décident, sans se connaître, d'échanger leurs appartements. Iris, va débarquer dans une demeure de rêve tandis que la distinguée Amanda découvre une petite maison de campagne sans prétentions. Les deux femmes pensent passer de paisibles vacances loin de la gent masculine, mais c'était sans compter l'arrivée du frère d'Iris dans la vie d'Amanda, et la rencontre de Miles pour Iris.",'categorie'=>"Comédie romantique"],
           ['id_film'=>1,'titre'=>"Dirty Dancing",'synopsis'=>"Été 1963. Bébé (Baby en VO) — de son vrai prénom Frédérique (Frances en VO) — fille d'une riche famille juive, passe ses vacances avec ses parents et sa sœur dans la région des montagnes Catskill dans l'état de New York, à la pension de la famille Kellerman. Elle se trouve mêlée à la vie des employés de la pension et se trouve confrontée à un monde qui lui est complètement étranger, celui de la danse. Malgré le désaccord de son père, Bébé va connaître une histoire d'amour avec Johnny, l'un des professeurs de danse de l'établissement, issu d'un milieu social très différent de celui de la jeune femme.",'categorie'=>"Musical"],
           ['id_film'=>2,'titre'=>"Top Gun",'synopsis'=>"Lors d'une manœuvre dans l'océan Indien, deux F-14 Tomcat de l'US Navy rencontrent deux MiG-28 au comportement hostile. Les pilotes parviennent à mettre les MiG en fuite, mais l'un d'entre eux, « Cougar », est en état de choc suite à l'accrochage. « Maverick », l'autre pilote, un chien fou peu apprécié de sa hiérarchie, retourne le chercher et l'aide à se poser sans casse sur leur porte-avions. Suite à l'incident, « Cougar » renonce au pilotage et le commandant, qui avait prévu de l'envoyer à Top Gun, l'école de l'élite de l'aéronavale américaine, se voit contraint d'affecter à sa place « Maverick » et son navigateur, « Goose ». « Maverick » y perfectionnera les techniques du combat aérien et se retrouvera en compétition avec un certain « Iceman » pour la première place au classement…",'categorie'=>"Action"],
           ['id_film'=>3,'titre'=>"Souviens-toi...l'été dernier",'synopsis'=>"La nuit de la fête nationale, Julie, Helen, Ray et Barry ont par accident renversé un inconnu. Devant la crainte de leur avenir compromis par ce drame, ils décident de faire disparaître le corps et font le serment de ne rien dire à personne, jamais. L'été suivant, chacun des quatre amis se trouve confronté à des évenements terrifiants. Ils doivent se rendre à l'évidence : quelqu'un sait ce qu'ils ont fait et semble bien decidé à le leur faire payer.",'categorie'=>"Horreur"],
           ['id_film'=>4,'titre'=>"Pearl Harbor",'synopsis'=>"L'histoire de Pearl Harbor nous entraîne dans l'avant-guerre américaine qui se déroule dans le Pacifique, dans le port de Pearl Harbor à Hawaï.",'categorie'=>"Aventure"]];
      
      //die(var_dump($films));

      return $this->render('TroiswaPublicBundle:film:films.html.twig', array('films'=>$films));
      */
      //l'objet $this recupere getDoctrine
      $em=$this->getDoctrine()->getManager();
      $films=$em->getRepository('TroiswaPublicBundle:Film')
      ->findAll();
    
        //die(\Doctrine\Common\Util\Debug::dump($films));
        return $this->render('TroiswaPublicBundle:film:films.html.twig',
        array('films'=>$films));


    }
 
public function filmAction($number)

{
      
      $em=$this->getDoctrine()->getManager();
      
      $film=$em->getRepository('TroiswaPublicBundle:Film')
      ->find($number);
      return $this->render('TroiswaPublicBundle:film:film.html.twig',
      array('film'=>$film));
      
      
    }


public function admin_film_ajouterAction(Request $request)

    {
    
    //creer le formulaire liée a la classe acteur
    
    $film = new Film();
    
    $formFilm=$this->createForm(new FilmType(), $film)
    //1 er parametre propriete et 2 type du champ et on peut avoir un troisieme parametre qui correspond toujour à un tableau 
    
    ->add('ajouter','submit');
    
   
    
    

    
        // die('POST');
        
        //recuperer les info passer dans le formulaire
        //$formActeur->bind($request);
         $formFilm->handleRequest($request);
        //fonction native qui renvoi true /false si formulaire valide
        if($formFilm->isValid())
        
        {
            $film->upload();
            $em=$this->getDoctrine()->getManager();
            //surveille l'objet $acteur
            $em->persist($film);
            //sauvgarder dans la base de donnée
            $em->flush();

            //pour afficher un message flach à l'utilisateur
            $session=$request->getSession();
            //fonction natve propre à symfony
            $session->getFlashBag()

            ->add('info', 'Votre film a été ajouté');

        

        //redirection sur la meme page on copie l'identifiant du routing
        return $this->redirect($this->generateUrl('troiswa_public_admin_film_ajouter'));

        }


    

    return $this->render('TroiswaPublicBundle:film:ajouter.html.twig',
    
    array('formFilm'=>$formFilm->createView()));
      
      
    }


}    