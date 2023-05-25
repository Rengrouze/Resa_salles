<?php
namespace Calendar;

class Booking
{
    private $id;
    private $day;

    private $temporary;
    private $idBookings;

    private $idRoom;

    private $admin_locked;



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


    public function getRoomId(): int
    {
        return $this->idRoom;
    }

    public function getAdminLocked(): int
    {
        return $this->admin_locked;
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
    public function getIdBookings(): int
    {
        return $this->idBookings;
    }


    public function setIdBookings($idBookings): self
    {
        $this->idBookings = $idBookings;

        return $this;
    }




    public function setRoomId($idRoom): self
    {
        $this->idRoom = $idRoom;

        return $this;
    }

    /**
     * Set the value of admin_locked
     *
     * @return  self
     */

    public function setAdminLocked(int $admin_locked)
    {
        $this->admin_locked = $admin_locked;

        return $this;
    }
}