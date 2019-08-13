### Di cosa si tratta

Esempio api di creazione eventi (evento con data e max 3 partecipanti).  

L’aggiunta dell’evento viene fatta tramite POST del seguente JSON a un endpoint

    /api/addEvent

Il seguente JSON è valido:
```
{
    "name": "evento test",
    "date": "2019-01-01 00:00:00",
    "users": ["Fabio", "Roby", "Grace"]
}
```

e la risposta deve essere “true”.

Il seguente JSON non è valido:
```
{
    "name": "evento test",
    "date": "2019-01-01 00:00:00",
    "users": ["Fabio", "Roby", "Grace”, “Pippo”]
}
```
e la risposta è “{"exception":"You can add up to 3 people to the event"}“


### Startup

```
composer install
php artisan migrate

```

È disponibile una collection di Postman nella cartella "postman"

