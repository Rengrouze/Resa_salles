<?php
namespace App;

class Room
{
    private $name;
    private $description;
    private $location;
    private $capacity;
    private $size;
    private $price;
    

    public function __construct($name, $description, $location, $capacity, $size, $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->location = $location;
        $this->capacity = $capacity;
        $this->size = $size;
        $this->price = $price;
    }

    

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getCapacity()
    {
        return $this->capacity;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getPrice()
    {
        return $this->price;
    }





}


