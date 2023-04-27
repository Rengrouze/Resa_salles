<?php
namespace Calendar;

class Client
{

    private $id;
    private $name;
    private $firstname;
    private $email;
    private $password;
    private $phone;
    private $business;
    private $siret;
    private $address;
    private $address_complement;
    private $city;
    private $postal_code;



    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getBusiness(): string
    {
        return $this->business;
    }


    public function getSiret()
    {
        return $this->siret;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getAddressComplement(): string
    {
        return $this->address_complement;
    }

    public function getPostalCode(): string
    {
        return $this->postal_code;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    // setters

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    public function setBusiness(string $business)
    {
        $this->business = $business;
    }

    public function setAddress(string $adress)
    {
        $this->address = $adress;
    }

    public function setAddressComplement(string $adress_complement)
    {
        $this->address_complement = $adress_complement;
    }

    public function setPostalCode(string $postal_code)
    {
        $this->postal_code = $postal_code;
    }

    public function setCity(string $city)
    {
        $this->city = $city;
    }

    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }




    /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }
}