<?php
// src/AppBundle/Entity/User.php

namespace EgmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="Facture")
 */
class Facture 
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
    protected $numfact;

     /**
     * @ORM\Column(type="integer", length=4)
     */
    protected $yearfact;

     /**
     * @ORM\Column(type="date")
     */
    protected $datefact;

     /**
     * @ORM\Column(type="string", length=255)
     */
    protected $societe;

     /**
     * @ORM\Column(type="boolean", options={"default":0})
     */
    protected $istva=0;

     /**
     * @ORM\Column(type="boolean", options={"default":0})
     */
    protected $isrg=0;

     /**
     * @ORM\Column(type="boolean", options={"default":0})
     */
    protected $isras=0;

     /**
     * @ORM\Column(type="boolean", options={"default":0})
     */
    protected $istva2=0;

     /**
     * @ORM\Column(type="boolean", options={"default":0})
     */
    protected $istimbre=0;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $tva;

     /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $rg;

     /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $ras;

     /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $tva2;

     /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $timbre;


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
     * Set societe
     *
     * @param string $societe
     *
     * @return Facture
     */
    public function setSociete($societe)
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * Get societe
     *
     * @return string
     */
    public function getSociete()
    {
        return $this->societe;
    }

    /**
     * Set numfact
     *
     * @param integer $numfact
     *
     * @return Facture
     */
    public function setNumfact($numfact)
    {
        $this->numfact = $numfact;

        return $this;
    }

    /**
     * Get numfact
     *
     * @return integer
     */
    public function getNumfact()
    {
        return $this->numfact;
    }

    /**
     * Set yearfact
     *
     * @param integer $yearfact
     *
     * @return Facture
     */
    public function setYearfact($yearfact)
    {
        $this->yearfact = $yearfact;

        return $this;
    }

    /**
     * Get yearfact
     *
     * @return integer
     */
    public function getYearfact()
    {
        return $this->yearfact;
    }

    /**
     * Set datefact
     *
     * @param \DateTime $datefact
     *
     * @return Facture
     */
    public function setDatefact($datefact)
    {
        $this->datefact = $datefact;

        return $this;
    }

    /**
     * Get datefact
     *
     * @return \DateTime
     */
    public function getDatefact()
    {
        return $this->datefact;
    }

    /**
     * Set istva
     *
     * @param boolean $istva
     *
     * @return Facture
     */
    public function setIstva($istva)
    {
        $this->istva = $istva;

        return $this;
    }

    /**
     * Get istva
     *
     * @return boolean
     */
    public function getIstva()
    {
        return $this->istva;
    }

    /**
     * Set isrg
     *
     * @param boolean $isrg
     *
     * @return Facture
     */
    public function setIsrg($isrg)
    {
        $this->isrg = $isrg;

        return $this;
    }

    /**
     * Get isrg
     *
     * @return boolean
     */
    public function getIsrg()
    {
        return $this->isrg;
    }

    /**
     * Set isras
     *
     * @param boolean $isras
     *
     * @return Facture
     */
    public function setIsras($isras)
    {
        $this->isras = $isras;

        return $this;
    }

    /**
     * Get isras
     *
     * @return boolean
     */
    public function getIsras()
    {
        return $this->isras;
    }

    /**
     * Set istva2
     *
     * @param boolean $istva2
     *
     * @return Facture
     */
    public function setIstva2($istva2)
    {
        $this->istva2 = $istva2;

        return $this;
    }

    /**
     * Get istva2
     *
     * @return boolean
     */
    public function getIstva2()
    {
        return $this->istva2;
    }

    /**
     * Set istimbre
     *
     * @param boolean $istimbre
     *
     * @return Facture
     */
    public function setIstimbre($istimbre)
    {
        $this->istimbre = $istimbre;

        return $this;
    }

    /**
     * Get istimbre
     *
     * @return boolean
     */
    public function getIstimbre()
    {
        return $this->istimbre;
    }

    /**
     * Set tva
     *
     * @param string $tva
     *
     * @return Facture
     */
    public function setTva($tva)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return string
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * Set rg
     *
     * @param string $rg
     *
     * @return Facture
     */
    public function setRg($rg)
    {
        $this->rg = $rg;

        return $this;
    }

    /**
     * Get rg
     *
     * @return string
     */
    public function getRg()
    {
        return $this->rg;
    }

    /**
     * Set ras
     *
     * @param string $ras
     *
     * @return Facture
     */
    public function setRas($ras)
    {
        $this->ras = $ras;

        return $this;
    }

    /**
     * Get ras
     *
     * @return string
     */
    public function getRas()
    {
        return $this->ras;
    }

    /**
     * Set tva2
     *
     * @param string $tva2
     *
     * @return Facture
     */
    public function setTva2($tva2)
    {
        $this->tva2 = $tva2;

        return $this;
    }

    /**
     * Get tva2
     *
     * @return string
     */
    public function getTva2()
    {
        return $this->tva2;
    }

    /**
     * Set timbre
     *
     * @param string $timbre
     *
     * @return Facture
     */
    public function setTimbre($timbre)
    {
        $this->timbre = $timbre;

        return $this;
    }

    /**
     * Get timbre
     *
     * @return string
     */
    public function getTimbre()
    {
        return $this->timbre;
    }

}
