<?php

namespace App\Command;


class AddEventCommand
{
    private $name;
    public function getName(): string
    {
        return $this->name;
    }

    private $date;
    public function getDate(): string
    {
        return $this->date;
    }

    private $users;
    public function getUsers(): array
    {
        return $this->users;
    }

    public function __construct(string $name, string $date, array $users)
    {
        $this->name = $name;
        $this->date = $date;
        $this->users = $users;
    }
}