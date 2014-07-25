<?php

namespace Troiswa\PublicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Film
 *
 * @ORM\Table(name="film")
 * @ORM\Entity(repositoryClass="Troiswa\PublicBundle\Entity\FilmRepository")
 */
class Film
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     * @Assert\NotBlank(message="vous n'avez pas rempli le champ titre")
     * @Assert\Length(
     *      min = "2",
     *      minMessage = "Votre nom doit faire au moins {{ 2 }} caractères",
     *      
     * ) 
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="synopsis", type="text")
     * @Assert\NotBlank(message="vous n'avez pas rempli le champ titre")
     * @Assert\Length(
     *      min = "5",
     *      maxMessage = "Votre nom doit faire maximum {{ 5 }} caractères",
     *      
     * ) 
     */
    private $synopsis;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="date")
     * @Assert\NotBlank(message="vous n'avez pas rempli le champ titre")
     */
    private $dateCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="realisateur", type="string")
     * @Assert\NotBlank(message="vous n'avez pas rempli le champ realisateur")
     * @Assert\Length(
     *      min = "2",
     *      minMessage = "Votre nom doit faire au moins {{ 2 }} caractères",
     *      
     * )
     */
    private $realisateur;

    /**
     * @var \int
     *
     * @ORM\Column(name="spectateur", type="integer")
     * @Assert\NotBlank(message="vous n'avez pas cocher le champ sexe")
     * @Assert\Choice(choices = {"0", "1","2","3","4", "5"}, message="Choisissez une note entre 0 et 5")
     */
    private $spectateur;

   

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string")
     *
     *
     *  
     */
    
    private $image;
    /**
     * une variable qui n'est pas lié à la base de donnée sans les annotation qui va traiter les inforamation du fichier image 
     */
    private $fichier;
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Troiswa\PublicBundle\Entity\Categorie",inversedBy="films")
     *
     *  
     */
    private $categorie;


   


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Film
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set synopsis
     *
     * @param string $synopsis
     * @return Film
     */
    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * Get synopsis
     *
     * @return string 
     */
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Film
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set realisateur
     *
     * @param string $realisateur
     * @return Film
     */
    public function setRealisateur($realisateur)
    {
        $this->realisateur = $realisateur;

        return $this;
    }

    /**
     * Get realisateur
     *
     * @return string 
     */
    public function getRealisateur()
    {
        return $this->realisateur;
    }

    /**
     * Set spectateur
     *
     * @param integer $spectateur
     * @return Film
     */
    public function setSpectateur($spectateur)
    {
        $this->spectateur = $spectateur;

        return $this;
    }

    /**
     * Get spectateur
     *
     * @return integer 
     */
    public function getSpectateur()
    {
        return $this->spectateur;
    }



    
    /**
     * Set image
     *
     * @param string $image
     * @return Film
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    public function getFichier()
    {
        return $this->fichier;

    }

    public function setFichier($fichier)
    {
        return $this->fichier = $fichier;
    }

     public function upload()
    
    {
     //if si on veut un acteur sans image on a la possibilie de le faire avec cette condition   
       if(null === $this->fichier)
        
        { 
        
        return;
        }

    //la fonction getUploadRootDir()cree le chemain vers le dossier quon veut uploader
      //pour changer le nom de image 
       $nameFile=$this->titre.'-'.uniqid().'.'.$this->fichier->guessExtension();
       $this->fichier->move($this->getUploadRootDir(), 
       $nameFile);
       //$this->fichier->getClientOriginalName());
       
       //$this->image=$this->fichier->getClientOriginalName();
       $this->image=$nameFile;
   }
    
    public function getUploadRootDir()

    {

        return __DIR__.'/../../../../web/'.$this->getuploadDir(); 
    }

    
    public function getWebPath()
    
    {
     
       if(null === $this->image)
        
        { 
        
        return null;
        
        }

        return $this->getuploadDir()."/".$this->image;
    
   }

    public function getuploadDir()
    
    {
     

        return "upload/Films";
    
   }


    /**
     * Set categorie
     *
     * @param \Troiswa\PublicBundle\Entity\Categorie $categorie
     * @return Film
     */
    
    //une variable par defaut null
    public function setCategorie(\Troiswa\PublicBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Troiswa\PublicBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}
