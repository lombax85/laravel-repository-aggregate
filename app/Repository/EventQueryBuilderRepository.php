<?php


namespace App\Repository;

use App\Event;
use Illuminate\Database\DatabaseManager;
use Symfony\Component\Serializer\Serializer;

class EventQueryBuilderRepository implements EventRepository
{
    /**
     * @var Event
     */
    private $event;
    /**
     * @var DatabaseManager
     */
    private $db;
    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct(Event $event, DatabaseManager $databaseManager, Serializer $serializer)
    {
        $this->event = $event;
        $this->db = $databaseManager;
        $this->serializer = $serializer;
    }

    public function add(Event $event): void
    {
        // insert event
        $insert = "INSERT INTO events (`id`, `name`, `date`, `users`) VALUES (?,?,?,?)";
        $this->db->insert($insert, [$event->getId(), $event->getName(), $event->getDate(), $this->serializer->serialize($event->getUsers(), 'json')]);
    }

    public function findById(int $id): ?Event
    {
        //TODO: finire
    }

    public function all(): array
    {
        $events =  $this->db->select("select * from events");

        // TODO: Eseguo un json_decode su users che è ancora in formato stringa. Per sostituire 'sta roba, devo implementare un custom extractor.
        // al momento sto usando PHPDocExtractor https://symfony.com/doc/current/components/property_info.html#phpdocextractor
        // devo creare un extractor specifico che esegua un json_decode sulla proprietà users prima di wrapparla a User
        foreach ($events as $k => $v) {
            $events[$k]->users = json_decode($events[$k]->users);
        }

        $deserialized = $this->serializer->deserialize(json_encode($events), 'App\Event[]','json');

        return $deserialized;
    }

    public function update(Event $event): void
    {
        //TODO: finire
    }

    public function delete(int $id): void
    {
        //TODO: finire
    }
}