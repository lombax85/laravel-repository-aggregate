<?php


namespace App\Handler;

use App\Command\AddEventCommand;
use App\Event;
use App\Repository\EventRepository;
use App\User;

class AddEventHandler
{
    private $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }
    public function handleAddEventCommand(AddEventCommand $command): void
    {
        try {

            // create Users
            $newUsers = [];
            foreach ($command->getUsers() as $userName) {
                $u = User::fromName($userName);
                $newUsers[] = $u;
            }

            // create event
            $event = Event::create($command->getName(), $command->getDate(), $newUsers);

            $this->eventRepository->add($event);

        } catch (\Exception $e) {
            throw $e;
        }
    }
}