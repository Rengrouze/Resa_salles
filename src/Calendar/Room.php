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
    private $address;
    private $address_complement;
    private $postal_code;
    private $city;




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

    public function getProjector(): int
    {
        return $this->projector;
    }

    public function getWifi(): int
    {
        return $this->wifi;
    }

    public function getCoffee(): int
    {
        return $this->coffee;
    }

    public function getWater(): int
    {
        return $this->water;
    }

    public function getPaperboard(): int
    {
        return $this->paperboard;
    }

    public function getTv(): int
    {
        return $this->tv;
    }

    public function getToilets(): int
    {
        return $this->toilets;
    }

    public function getParking(): int
    {
        return $this->parking;
    }

    public function getDisabledAccess(): int
    {
        return $this->disabledAccess;
    }

    public function getAirConditioning(): int
    {
        return $this->airConditioning;
    }

    // ...

    public function setProjector(int $projector)
    {
        $this->projector = $projector;
    }

    public function setWifi(int $wifi)
    {
        $this->wifi = $wifi;
    }

    public function setCoffee(int $coffee)
    {
        $this->coffee = $coffee;
    }

    public function setWater(int $water)
    {
        $this->water = $water;
    }

    public function setPaperboard(int $paperboard)
    {
        $this->paperboard = $paperboard;
    }

    public function setTv(int $tv)
    {
        $this->tv = $tv;
    }

    public function setToilets(int $toilets)
    {
        $this->toilets = $toilets;
    }

    public function setParking(int $parking)
    {
        $this->parking = $parking;
    }

    public function setDisabledAccess(int $disabledAccess)
    {
        $this->disabledAccess = $disabledAccess;
    }

    public function setAirConditioning(int $airConditioning)
    {
        $this->airConditioning = $airConditioning;
    }

    public function getAddress(): string
    {
        return htmlentities($this->address);
    }

    public function getAddressComplement(): string
    {
        return htmlentities($this->address_complement);
    }

    public function getPostalCode(): string
    {
        return htmlentities($this->postal_code);
    }

    public function getCity(): string
    {
        return htmlentities($this->city);
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

    

    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    public function setAddressComplement(string $address_complement)
    {
        $this->address_complement = $address_complement;
    }

    public function setPostalCode(string $postal_code)
    {
        $this->postal_code = $postal_code;
    }

    public function setCity(string $city)
    {
        $this->city = $city;
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

    public function getFrenchOptionsName(): array
    {
        return [
            'projector' => 'Vidéoprojecteur',
            'wifi' => 'Wifi',
            'coffee' => 'Café',
            'water' => 'Eau',
            'paperboard' => 'Paperboard',
            'tv' => 'TV',
            'toilets' => 'Toilettes',
            'parking' => 'Parking',
            'disabledAccess' => 'Accès handicapé',
            'airConditioning' => 'Climatisation'
        ];
    }

    







}



