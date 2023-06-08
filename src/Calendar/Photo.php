<?php

namespace Calendar;

class Photo {
    private $id;
    private $id_room;
    private $min;


    public function getId(): int
    {
        return $this->id;
    }

    public function getIdRoom(): int
    {
        return $this->id_room;
    }

    public function getMin(): string
    {
        return $this->min;
    }

    public function setRoomId(int $id_room)
    {
        $this->id_room = $id_room;
    }

    // min is a int
    public function setMin(int $min)
    {
        $this->min = $min;
    }
    
}