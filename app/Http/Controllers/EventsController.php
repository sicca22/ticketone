<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventCollection;

class EventsController extends Controller {
    public function __construct() {
    }

    public function index() {
        // Lumen è un framework MVC (Model View Controller)
        // Che significa?
        // Utente fa chiamata (e.g. Postman) -> chiamata arriva al router (web.php) ->
        // router invia a controller (qui) ->  controller esegue query utilizzando model (e.g. Event:all())->
        // model restituisce il risultato a controller ($events) ->
        // controller utilizza una view per rispondere a utente (e.g. new EventCollection($events))
        // Le view vengono generalmente utilizzate per siti web
        // noi stiamo costruendo servizi RESTful e quindi utilizzeremo le Risorse
        // anzichè le view (MA È LA STESSA INDENTICA COSA)

        // Primo passo nel controller, uso il modello per effettuare una query
        // Per ogni tabella del database ci deve essere una classe PHP nei models
        // I nomi delle tabelle devono essere plurale e.g. events
        // I nomi dei modelli devono essere al singolare e.g. Event
        $events = Event::all(); // SELECT * FROM events; (https://laravel.com/docs/9.x/eloquent#collections)

        // Utilizzo una risorsa per ritornare il risultato all'utente (https://laravel.com/docs/9.x/eloquent-resources)
        return new EventCollection($events);
    }

    public function show($id) {
        // Recupero il singolo evento utilizzando l'indentificativo (ID)
        // Il find ritorna un oggetto Event se esiste, altrimenti
        // ritorna null
        $event = Event::find($id);

        if ($event) { // È true solo se l'oggetto non è null
            // Ritorno l'evento all'utente
            return new EventResource($event);
        } else { // Vuol dire che l'oggetto non è stato trovato
            return $this->failure('The searched event does not exist', 1, 404);
        }
    }


    
    public function create(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|min:3',
            'description' => 'required|string',
            'date' => 'required|date',
            'cover_url' => 'url',
            'price' => 'required|numeric',
            'address' => 'required|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'views_count' => 'required|integer',
            'comments_count' => 'required|integer',
            'likes_count' => 'required|integer'
        ]);

        // $request->all() serve per recuperare tutte le informazioni
        // presenti nel body della richiesta
        // Utilizzo new Event per initializzare un evento con tutte
        // le informazioni presenti nel body della richiesta (AKA params -> parametri della richiesta)
        $event = new Event($request->all());
        // La richista di salvataggio viene fatta al DB tramite Eloquent utilizzando PDO.
        $event->save();

        // Questi sono due modi per fare la stessa cosa.
        // Ovvero creare un evento passando i parametri
        // presenti nel body della richiesta

        // $event = new Event();
        // $event->name = $request->name;
        // $event->description = $request->description;
        // $event->date = $request->date;
        // $event->cover_url = $request->cover_url;
        // $event->price = $request->price;
        // $event->address = $request->address;
        // $event->lat = $request->lat;
        // $event->lng = $request->lng;
        // $event->views_count = $request->views_count;
        // $event->comments_count = $request->comments_count;
        // $event->likes_count = $request->likes_count;
        // $event->save();

        return new EventResource($event);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'string|min:3',
            'description' => 'string',
            'date' => 'date',
            'cover_url' => 'url',
            'price' => 'numeric',
            'address' => 'string',
            'lat' => 'numeric',
            'lng' => 'numeric',
            'views_count' => 'integer',
            'comments_count' => 'integer',
            'likes_count' => 'integer'
        ]);

        // Recupero l'evento che voglio modificare
        // usando l'ID passato nella URL
        $event = Event::find($id);

        if ($event) { // È true solo se l'oggetto non è null
            $event->update($request->all());
            return new EventResource($event);
        } else { // Vuol dire che l'oggetto non è stato trovato
            return $this->failure('The searched event does not exist', 1, 404);
        }
    }
    public function delete($id) {
        $event = Event::find($id);
        if(!$event) {
            $event->delete();
            return Event::all();
        } else {
            return $this->failure(message: "The event in deleted", internalCode: 1, statusCode: 404);
        }
            
    }
}