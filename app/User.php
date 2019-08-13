<?php

namespace App;

class User
{
    private $id;
    private $name;

    private function __construct()
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function fromName(string $name): User
    {
        $user = new self;
        $user->id = uniqid("", true);
        $user->name = $name;

        return $user;
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

}
