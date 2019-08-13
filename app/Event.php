<?php

namespace App;

class Event
{
    private $id;
    private $name;
    private $date;

    /**
     * @var User[]
     */
    private $users;

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return User[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }

    /**
     * @param string $name
     * @param string $date
     * @param User[] $users
     * @return Event
     * @throws \Exception
     */
    public static function create(string $name, string $date, array $users): self
    {
        // check business logic
        if (count($users) > 3) {
            throw new \Exception('You can add up to 3 people to the event');
        }

        // we can go further
        // persist the models first, otherwise Laravel won't add the relationship

        $event = new self;
        $event->id = uniqid("",true);
        $event->name = $name;
        $event->date = $date;
        $event->users = $users;

        return $event;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @param User[] $users
     */
    public function setUsers(array $users): void
    {
        $this->users = $users;
    }


}
