<?php

namespace Troiswa\PublicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * acteur
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Troiswa\PublicBundle\Entity\acteurRepository")
 */
class acteur
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
     * @ORM\Column(name="prenom", type="string", length=255)
     * @Assert\NotBlank(message="vous n'avez pas rempli le champ prenom")
     * @Assert\Length(
     *      min = "2",
     *      minMessage = "Votre nom doit faire au moins {{ 2 }} caractères",
     *      
     * )      
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\NotBlank(message="vous n'avez pas rempli le champ nom")
     * @Assert\Length(
     *      min = "2",
     *      minMessage = "Votre nom doit faire au moins {{ 2 }} caractères",
     *      
     * ) 
     */
    private $nom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="date")
     * @Assert\NotBlank(message="vous n'avez pas selectionner la Date de naissance")
     */
    private $dateNaissance;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sexe", type="boolean")
     * @Assert\NotBlank(message="vous n'avez pas cocher le champ sexe")
     * @Assert\Choice(choices = {"0", "1"}, message="Choisissez un sexe valide")
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="nationalité", type="string", length=255)
     * @Assert\NotBlank(message="vous n'avez pas rempli le champ nationalite")
     *      
     * )   
     */
    private $nationalite;

    /**
     * @var string
     *
     * @ORM\Column(name="biographie", type="text")
     * @Assert\NotBlank(message="vous n'avez pas rempli le champ biographie")
     * @Assert\Length(
     *      min = "10",
     *      minMessage = "La biographie doit faire au moins {{ 10 }} caractères",
     *      
     * )   
     */
    private $biographie;

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
     * @Assert\NotBlank()
     * @Assert\Image( maxSize="1000k",
     *                maxSizeMessage="le fichier est trop lourd",
     * 
     *                mimeTypes={ "image/jpg", "image/png","image/jpeg" },
     *                mimeTypesMessage="veuillez inserer une extention valide de l'image"  
     *)
     * 
     */
    private $fichier;



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
     * Set prenom
     *
     * @param string $prenom
     * @return acteur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return acteur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     * @return acteur
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime 
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return acteur
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set nationalité
     *
     * @param string $nationalité
     * @return acteur
     */
    public function setNationalite($nationalité)
    {
        $this->nationalite = $nationalité;

        return $this;
    }

    /**
     * Get nationalité
     *
     * @return string 
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }



    /**
     * Set biographie
     *
     * @param string $biographie
     * @return acteur
     */
    public function setBiographie($biographie)
    {
        $this->biographie = $biographie;

        return $this;
    }

    /**
     * Get biographie
     *
     * @return string 
     */
    public function getBiographie()
    {
        return $this->biographie;
    }
    /**
     * Get gender
     *
     * @return string 
     */
    
    public function getGender()
    
    {

        if($this->sexe == 0){   
        
        return "femme";
    
    }else

return "homme";
}
    
    public function getShortBiographie($length=200, $last="...")
        {
            if(strlen($this->biographie)<$length)
            {
               return$this->biographie;
            }
            $string=substr($this->biographie, 0, $length);
            $pos=strrpos($string," ");
            return substr($string,0,$pos).$last; 
        }

    public function getAge() {
      
      $dateInterval = $this->dateNaissance->diff(new \DateTime());
 
        return $dateInterval->y;
      
    }    




    /**
     * Set image
     *
     * @param string $image
     * @return acteur
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

     /**
     * fonction pour deplacer le fichier et garder le meme nom de l image 
     */


    public function upload()
    
    {
     //if si on veut un acteur sans image on a la possibilie de le faire avec cette condition   
       if(null === $this->fichier)
        
        { 
        
        return;
        }

    //la fonction getUploadRootDir()cree le chemain vers le dossier quon veut uploader

       $this->fichier->move($this->getUploadRootDir(), 
       $this->fichier->getClientOriginalName());
       
       $this->image=$this->fichier->getClientOriginalName();
    
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
     

        return "upload/Acteurs";
    
   }







}
