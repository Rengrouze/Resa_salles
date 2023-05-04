<?php
namespace Calendar;

class Booking
{
    private $id;
    private $day;
    
    private $temporary;
    private $idBookings;

    private $idRoom;




    public function getId(): int
    {
        return $this->id;
    }

   

    public function getDay(): \DateTimeInterface
    {
        return new \DateTimeImmutable($this->day);
    }

   
    

    public function getTemporary(): bool
    {
        return $this->temporary;
    }

    // setters

    

    public function setDay(\DateTimeInterface $day)
    {
        $this->day = $day->format('Y-m-d');
    }

    
    public function setTemporary(bool $temporary)
    {
        $this->temporary = $temporary;
    }

    /**
     * Get the value of idBookings
     */ 
    public function getIdBookings() : int
    {
        return $this->idBookings;
    }

    
    public function setIdBookings($idBookings) : self
    {
        $this->idBookings = $idBookings;

        return $this;
    }

    /**
     * Get the value of room
     */
    public function getRoomId() : int
    {
        return $this->idRoom;
    }


    public function setRoomId($idRoom) : self
    {
        $this->idRoom = $idRoom;

        return $this;
    }
}