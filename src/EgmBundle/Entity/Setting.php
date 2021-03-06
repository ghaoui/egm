<?php


namespace EgmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="Setting")
 */
class Setting 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

     /**
     * @ORM\Column(type="string", length=5)
     */
    protected $tva;

     /**
     * @ORM\Column(type="string", length=5)
     */
    protected $rg;

     /**
     * @ORM\Column(type="string", length=5)
     */
    protected $ras;

     /**
     * @ORM\Column(type="string", length=5)
     */
    protected $tva2;

     /**
     * @ORM\Column(type="string", length=5)
     */
    protected $timbre;

     /**
     * @ORM\Column(type="string", length=5)
     */
    protected $year;

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
     * Set tva
     *
     * @param string $tva
     *
     * @return Setting
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
     * Set tns
     *
     * @param string $tns
     *
     * @return Setting
     */
    public function setTns($tns)
    {
        $this->tns = $tns;

        return $this;
    }

    /**
     * Get tns
     *
     * @return string
     */
    public function getTns()
    {
        return $this->tns;
    }

    /**
     * Set tbs
     *
     * @param string $tbs
     *
     * @return Setting
     */
    public function setTbs($tbs)
    {
        $this->tbs = $tbs;

        return $this;
    }

    /**
     * Get tbs
     *
     * @return string
     */
    public function getTbs()
    {
        return $this->tbs;
    }

    /**
     * Set rg
     *
     * @param string $rg
     *
     * @return Setting
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
     * @return Setting
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
     * @return Setting
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
     * @return Setting
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

    /**
     * Set year
     *
     * @param string $year
     *
     * @return Setting
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }
}
