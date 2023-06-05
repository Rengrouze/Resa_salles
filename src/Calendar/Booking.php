<?php
namespace Calendar;

class Booking
{
    private $id;
    private $day;

    private $temporary;
    private $id_bookings;

    private $id_room;

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
        return $this->id_room;
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
        return $this->id_bookings;
    }


    public function setIdBookings($id_bookings): self
    {
        $this->id_bookings = $id_bookings;

        return $this;
    }




    public function setRoomId($id_room): self
    {
        $this->id_room = $id_room;

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