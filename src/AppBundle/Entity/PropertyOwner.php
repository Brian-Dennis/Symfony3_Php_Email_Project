<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PropertyOwner
 *
 * @ORM\Table(name="property_owner")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Property_OwnerRepository")
 */
class PropertyOwner
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_numbers", type="text", nullable=true)
     */
    private $phoneNumbers;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_main", type="string", length=255, nullable=true)
     */
    private $phoneMain;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_mobile", type="string", length=255, nullable=true)
     */
    private $phoneMobile;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_office", type="string", length=255, nullable=true)
     */
    private $phoneOffice;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="properties", type="text", nullable=true)
     */
    private $properties;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;


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
     * Set name
     *
     * @param string $name
     *
     * @return PropertyOwner
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
     * Set phoneNumbers
     *
     * @param string $phoneNumbers
     *
     * @return PropertyOwner
     */
    public function setPhoneNumbers($phoneNumbers)
    {
        $this->phoneNumbers = $phoneNumbers;

        return $this;
    }

    /**
     * Get phoneNumbers
     *
     * @return string
     */
    public function getPhoneNumbers()
    {
        return $this->phoneNumbers;
    }

    /**
     * Set phoneMain
     *
     * @param string $phoneMain
     *
     * @return PropertyOwner
     */
    public function setPhoneMain($phoneMain)
    {
        $this->phoneMain = $phoneMain;

        return $this;
    }

    /**
     * Get phoneMain
     *
     * @return string
     */
    public function getPhoneMain()
    {
        return $this->phoneMain;
    }

    /**
     * Set phoneMobile
     *
     * @param string $phoneMobile
     *
     * @return PropertyOwner
     */
    public function setPhoneMobile($phoneMobile)
    {
        $this->phoneMobile = $phoneMobile;

        return $this;
    }

    /**
     * Get phoneMobile
     *
     * @return string
     */
    public function getPhoneMobile()
    {
        return $this->phoneMobile;
    }

    /**
     * Set phoneOffice
     *
     * @param string $phoneOffice
     *
     * @return PropertyOwner
     */
    public function setPhoneOffice($phoneOffice)
    {
        $this->phoneOffice = $phoneOffice;

        return $this;
    }

    /**
     * Get phoneOffice
     *
     * @return string
     */
    public function getPhoneOffice()
    {
        return $this->phoneOffice;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return PropertyOwner
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set properties
     *
     * @param string $properties
     *
     * @return PropertyOwner
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * Get properties
     *
     * @return string
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return PropertyOwner
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }
}

