<?php

namespace Calendar;

class Room
{

    private $id;
    private $name;
    private $capacity;
    private $seats;
    private $description;
    private $imagePath;
    private $price;
    private $location;
    private $size;

    private $projector;
    private $wifi;
    private $coffee;
    private $water;
    private $paperboard;
    private $tv;
    private $toilets;
    private $parking;
    private $disabledAccess;
    private $airConditioning;

    
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return htmlentities($this->name);
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function getSeats(): int
    {
        return $this->seats;
    }

    public function getDescription(): string
    {
        return htmlentities($this->description);
    }

    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    public function getPrice(): int
    {
        return $this->price;
    }


    public function getLocation(): string
    {
        return htmlentities($this->location);
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getProjector(): bool
    {
        return $this->projector;
    }

    public function getWifi(): bool
    {
        return $this->wifi;
    }

    public function getCoffee(): bool
    {
        return $this->coffee;
    }

    public function getWater(): bool
    {
        return $this->water;
    }

    public function getPaperboard(): bool
    {
        return $this->paperboard;
    }

    public function getTv(): bool
    {
        return $this->tv;
    }

    public function getToilets(): bool
    {
        return $this->toilets;
    }

    public function getParking(): bool
    {
        return $this->parking;
    }

    public function getDisabledAccess(): bool
    {
        return $this->disabledAccess;
    }

    public function getAirConditioning(): bool
    {
        return $this->airConditioning;
    }

    // setters

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setCapacity(int $capacity)
    {
        $this->capacity = $capacity;
    }

    public function setSeats(int $seats)
    {
        $this->seats = $seats;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function setImagePath(string $imagePath)
    {
        $this->imagePath = $imagePath;
    }

    public function setPrice(int $price)
    {
        $this->price = $price;
    }

    public function setLocation(string $location)
    {
        $this->location = $location;
    }

    public function setSize(int $size)
    {
        $this->size = $size;
    }

    public function setProjector(bool $projector)
    {
        $this->projector = $projector;
    }

    public function setWifi(bool $wifi)
    {
        $this->wifi = $wifi;
    }

    public function setCoffee(bool $coffee)
    {
        $this->coffee = $coffee;
    }

    public function setWater(bool $water)
    {
        $this->water = $water;
    }

    public function setPaperboard(bool $paperboard)
    {
        $this->paperboard = $paperboard;
    }

    public function setTv(bool $tv)
    {
        $this->tv = $tv;
    }

    public function setToilets(bool $toilets)
    {
        $this->toilets = $toilets;
    }

    public function setParking(bool $parking)
    {
        $this->parking = $parking;
    }

    public function setDisabledAccess(bool $disabledAccess)
    {
        $this->disabledAccess = $disabledAccess;
    }

    public function setAirConditioning(bool $airConditioning)
    {
        $this->airConditioning = $airConditioning;
    }

    // get options

    public function getOptions(): array
    {
        return [
            'projector' => $this->projector,
            'wifi' => $this->wifi,
            'coffee' => $this->coffee,
            'water' => $this->water,
            'paperboard' => $this->paperboard,
            'tv' => $this->tv,
            'toilets' => $this->toilets,
            'parking' => $this->parking,
            'disabledAccess' => $this->disabledAccess,
            'airConditioning' => $this->airConditioning
        ];
    }

    







}



