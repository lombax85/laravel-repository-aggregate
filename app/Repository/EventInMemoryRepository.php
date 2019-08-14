<?php


namespace App\Repository;


use App\Event;

class EventInMemoryRepository implements EventRepository
{
    /**
     * @var Event
     */
    private $model;

    private $items = [];

    public function __construct(Event $model)
    {
        $this->model = $model;
        $this->items = [];
    }

    public function add(Event $event): void
    {
        $this->items[$event->getId()] = $event;
    }

    public function findById(int $id): ?Event
    {
        return $this->items[$id];
    }

    public function all(): array
    {
        return array_values($this->items);
    }

    public function update(Event $event): void
    {
        $this->items[$event->getId()] = $event;
    }

    public function delete(int $id): void
    {
        unset($this->items[$id]);
    }
}