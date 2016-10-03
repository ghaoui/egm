<?php


namespace EgmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="Factureprod")
 */
class Factureprod 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $idfacture;
     /**
     * @ORM\Column(type="string", length=255)
     */
    protected $ref; 

     /**
     * @ORM\Column(type="string", length=255)
     */
    protected $name;


     /**
     * @ORM\Column(type="decimal", precision=10)
     */
    protected $price;

     /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    protected $qte;

     /**
     * @ORM\Column(type="decimal", precision=10)
     */
    protected $totalprice;

    

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
     * Set idfacture
     *
     * @param integer $idfacture
     *
     * @return Factureprod
     */
    public function setIdfacture($idfacture)
    {
        $this->idfacture = $idfacture;

        return $this;
    }

    /**
     * Get idfacture
     *
     * @return integer
     */
    public function getIdfacture()
    {
        return $this->idfacture;
    }

    /**
     * Set ref
     *
     * @param string $ref
     *
     * @return Factureprod
     */
    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }

    /**
     * Get ref
     *
     * @return string
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Factureprod
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Factureprod
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set totalprice
     *
     * @param string $totalprice
     *
     * @return Factureprod
     */
    public function setTotalprice($totalprice)
    {
        $this->totalprice = $totalprice;

        return $this;
    }

    /**
     * Get totalprice
     *
     * @return string
     */
    public function getTotalprice()
    {
        return $this->totalprice;
    }

    /**
     * Set qte
     *
     * @param string $qte
     *
     * @return Factureprod
     */
    public function setQte($qte)
    {
        $this->qte = $qte;

        return $this;
    }

    /**
     * Get qte
     *
     * @return string
     */
    public function getQte()
    {
        return $this->qte;
    }
}
