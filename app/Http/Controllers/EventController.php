<?php

namespace App\Http\Controllers;

use App\Command\AddEventCommand;
use App\Handler\AddEventHandler;
use App\Repository\EventRepository;
use Illuminate\Http\Request;
use Symfony\Component\Serializer\Serializer;

class EventController extends Controller
{
    private $eventRepository;
    /**
     * @var AddEventHandler
     */
    private $addEventHandler;
    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct(EventRepository $eventRepository, AddEventHandler $addEventHandler, Serializer $serializer)
    {
        $this->eventRepository = $eventRepository;
        $this->addEventHandler = $addEventHandler;
        $this->serializer = $serializer;
    }

    public function addEvent(Request $request)
    {
        $obj = json_decode($request->getContent(), true);

        $addEventCommand = new AddEventCommand($obj['name'], $obj['date'], $obj['users']);
        try {
            $this->addEventHandler->handleAddEventCommand($addEventCommand);
            return json_encode(true); // TODO: lanciare un evento a creazione riuscita ritornare l'id dell'evento
        } catch (\Exception $e) {
            return json_encode(['exception' => $e->getMessage()]);
        }
    }

    public function showEvents()
    {
        $json = $this->serializer->serialize($this->eventRepository->all(), 'json');
        return json_decode($json)
    }
}
