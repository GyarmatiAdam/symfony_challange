<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cars
 *
 * @ORM\Table(name="cars")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarsRepository")
 */
class Cars
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="carName", type="string", length=60)
     */
    private $carName;

    /**
     * @var string
     *
     * @ORM\Column(name="carType", type="string", length=60)
     */
    private $carType;

    /**
     * @var string
     *
     * @ORM\Column(name="carDate", type="string", length=30)
     */
    private $carDate;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set carName
     *
     * @param string $carName
     *
     * @return Cars
     */
    public function setCarName($carName)
    {
        $this->carName = $carName;

        return $this;
    }

    /**
     * Get carName
     *
     * @return string
     */
    public function getCarName()
    {
        return $this->carName;
    }

    /**
     * Set carType
     *
     * @param string $carType
     *
     * @return Cars
     */
    public function setCarType($carType)
    {
        $this->carType = $carType;

        return $this;
    }

    /**
     * Get carType
     *
     * @return string
     */
    public function getCarType()
    {
        return $this->carType;
    }

    /**
     * Set carDate
     *
     * @param string $carDate
     *
     * @return Cars
     */
    public function setCarDate($carDate)
    {
        $this->carDate = $carDate;

        return $this;
    }

    /**
     * Get carDate
     *
     * @return string
     */
    public function getCarDate()
    {
        return $this->carDate;
    }
}

