<?php
namespace Calendar;

class Event
{

    private $id;
    private $id_client;

    private $number_of_days;
    private $days;
    private $reason;
    private $total_price;
    private $temporary;
    private $id_room;

    private $admin_locked;



    public function getId(): int
    {
        return $this->id;
    }

    public function getIdClient(): int
    {
        return $this->id_client;
    }

    public function getNumberOfDays(): int
    {
        return $this->number_of_days;
    }

    public function getDays(): string
    {
        return $this->days;
    }

    public function getReason(): string
    {
        return $this->reason;
    }

    public function getTotalPrice(): int
    {
        return $this->total_price;
    }

    public function getTemporary(): bool
    {
        return $this->temporary;
    }

    public function getRoomId(): int
    {
        return $this->id_room;
    }

    public function getAdminLocked(): bool
    {
        return $this->admin_locked;
    }


    // setters

    public function setIdClient(int $idClient)
    {
        $this->id_client = $idClient;
    }

    public function setNumberOfDays(int $numberOfDays)
    {
        $this->number_of_days = $numberOfDays;
    }

    public function setDays(string $daysId)
    {
        $this->days = $daysId;
    }

    public function setReason(string $reason)
    {
        $this->reason = $reason;
    }

    public function setTotalPrice(int $total_price)
    {
        $this->total_price = $total_price;
    }

    public function setTemporary(bool $temporary)
    {
        $this->temporary = $temporary;
    }

    public function setRoomId(int $id_room)
    {
        $this->id_room = $id_room;
    }

    public function setAdminLocked(bool $admin_locked)
    {
        $this->admin_locked = $admin_locked;
    }




}