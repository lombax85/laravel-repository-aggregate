<?php

namespace App\Repository;

use App\Event;

interface EventRepository
{
    public function add(Event $event): void;

    public function findById(int $id):? Event;

    public function all(): array;

    public function update(Event $event): void;

    public function delete(int $id): void;
}