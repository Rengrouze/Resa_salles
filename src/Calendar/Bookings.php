<?php

namespace Calendar;

class Bookings
{

    private $pdo;


    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    /**
     * Récupère les réservations commençant entre deux dates
     * @param \DateTime $start
     * @param \DateTime $end
     * @return array
     */

    public function getBookingsBetween(\DateTimeInterface $start, \DateTimeInterface $end)
    {
        $sql = "SELECT * FROM bookings WHERE day BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}'";
        $statement = $this->pdo->query($sql);
        $statement->setFetchMode(\PDO::FETCH_CLASS, Booking::class);
        $results = $statement->fetchAll();
        return $results;
    }

    /**
     * Récupérer les reservations commencant entre deux dates par salle
     * @param \DateTime $start
     * @param \DateTime $end
     * @param string $room
     * @return array
     */

    public function getBookingsBetweenByRoom(\DateTimeInterface $start, \DateTimeInterface $end, string $room)
    {
        $sql = "SELECT * FROM bookings WHERE room = '{$room}' AND day BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}'";
        $statement = $this->pdo->query($sql);
        $statement->setFetchMode(\PDO::FETCH_CLASS, Booking::class);
        $results = $statement->fetchAll();
        return $results;
    }
     

    /**
     * Vérifie si les jours sont déjà réservés
     * @param array $days
     * @return array
     */
    public function getBookedDays(array $days)
    {
        $sql = "SELECT day FROM bookings WHERE day IN ('" . implode("', '", $days) . "')";
        $statement = $this->pdo->query($sql);
        $results = $statement->fetchAll(\PDO::FETCH_COLUMN);
        return $results;
    }

    /**
     * vérifie si les jours sont déja réservés en fonction de la salle
     * @param array $days
     * @param string $room
     * @return array
     */
    public function getBookedDaysByRoom(array $days, string $room)
    {
        $sql = "SELECT day FROM bookings WHERE day IN ('" . implode("', '", $days) . "') AND room = '{$room}'";
        $statement = $this->pdo->query($sql);
        $results = $statement->fetchAll(\PDO::FETCH_COLUMN);
        return $results;
    }
     

    public function getNextAvailableDays() {
        $availableDays = [];
    
        $tomorrow = new \DateTime('tomorrow');
    
        while (count($availableDays) < 7) {
            $sql = "SELECT * FROM bookings WHERE day = '{$tomorrow->format('Y-m-d')}'";
            $statement = $this->pdo->query($sql);
            $result = $statement->fetch();
    
            if (!$result) {
                $availableDays[] = $tomorrow->format('Y-m-d');
            }
    
            $tomorrow = $tomorrow->modify('+1 day');
        }
    
        return $availableDays;
    }
    
    
    









    public function hydrateEvent(Event $event, array $data)
    {
        $event->setIdClient($data['idClient']);
        $event->setNumberOfDays($data['numberOfDays']);
        $event->setDays($data['days']);
        $event->setReason($data['reason']);
        $event->setTotalPrice($data['totalPrice']);
        $event->setTemporary($data['temporary']);
        $event->setRoom($data['room']);

        return $event;

    }

    public function createEvent(Event $event)
    {
        $statement = $this->pdo->prepare("INSERT INTO events (id_client, number_of_days, days, reason, total_price, temporary, room) VALUES (?, ?, ?, ?, ?, ?,?)");
        $statement->execute([
            $event->getIdClient(),
            $event->getNumberOfDays(),
            $event->getDays(),
            $event->getReason(),
            $event->getTotalPrice(),
            $event->getTemporary(),
            $event->getRoom()
        ]);
        return $this->pdo->lastInsertId();
    }


    public function getEventById($idEvent)
    {
        $statement = $this->pdo->prepare("SELECT * FROM events WHERE id = ?");
        $statement->execute([$idEvent]);
        $statement->setFetchMode(\PDO::FETCH_CLASS, Event::class);
        $results = $statement->fetch();
        return $results;
    }







    public function hydrateBooking(Booking $booking, array $data)
    {

        // setDay should be a date object
        $booking->setDay(new \DateTime($data['day']));
        $booking->setTemporary($data['temporary']);
        $booking->setIdBookings($data['idBookings']);
        $booking->setRoom($data['room']);

        return $booking;
    }



    /**
     * Crée une réservation
     * @param Booking $booking
     * @return bool
     */
    public function createBooking(Booking $booking)
    {


        // for each number of days, create a booking
        $statement = $this->pdo->prepare("INSERT INTO bookings (day,  temporary, id_bookings, room) VALUES (?,  ?, ?,?)");
        $statement->execute([
            $booking->getDay()->format('Y-m-d'),
            $booking->getTemporary(),
            $booking->getIdBookings(),
            $booking->getRoom()
        ]);
        // return the ids of the created bookings
        return $this->pdo->lastInsertId();
    }

    public function getAllEventsByClient($idClient)
    {
        $statement = $this->pdo->prepare("SELECT * FROM events WHERE id_client = ?");
        $statement->execute([$idClient]);
        $statement->setFetchMode(\PDO::FETCH_CLASS, Event::class);
        $results = $statement->fetchAll();
        return $results;
    }

    public function deleteEventAndBookings($idEvent)
    {
        $statement = $this->pdo->prepare("DELETE FROM events WHERE id = ?");
        $statement->execute([$idEvent]);
        $statement = $this->pdo->prepare("DELETE FROM bookings WHERE id_bookings = ?");
        $statement->execute([$idEvent]);
    }

    public function confirmEventAndAssociatedBookings($idEvent)
    {
        $statement = $this->pdo->prepare("UPDATE events SET temporary = 0 WHERE id = ?");
        $statement->execute([$idEvent]);
        $statement = $this->pdo->prepare("UPDATE bookings SET temporary = 0 WHERE id_bookings = ?");
        $statement->execute([$idEvent]);
        // return a boolean to confirm the update
        return $statement->rowCount() > 0;
    }






}