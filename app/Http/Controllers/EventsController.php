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
        //lumen è un fremework MVC
    //richiesta -> arriva al router -> router invia a controller -> controller esegue query utilizzando model
    //model restituisce il risultato a controller -> controller utilizza un view pre rispondere all'utente 
    //noi utilizziamo le risorse al posto delle view perchè costruiamo un servizio restful 

    //uso il modello per effetturare una query
    //per ogni tabella ci deve essere una classe pho nel models 
    //nomi tabelle plurali lettera m e M
    //nomi modelli singolari lettera M
    
        $events = Event::all(); //recupre gli elementi - Select = from events; sql 

        //utilizzo una risorsa per far vedere il risultato all'utente

        return new EventCollection($events);
    }
    public function show($id) {
 //richiamo ogni singolo evento utilizzano id
 //il find ritorna un oggetto event se esiste altrimenti null
 $event = Event::find($id);
 if ($event) {
     // ritorno l'veneto dell'utente
    return new EventResource($event);
    }else{ //se non è stato trovato
     return $this->failure('evento specifico non esiste' , 1, 404);
        }
    }

//tuttte le chiamate post e put utilizzano la request per recuperare i dati
    
    //si possono aggiundere parametri nel body nelle chiamate post
    public function create(Request $request){
        $this->validate($request, [

        'name' => 'required|min:3',
        'descriptio' => 'required|string',
        'date' => 'required|date',
        'cover_url' => 'required|url',
        'price' => 'required|numeric',
        'address' => 'required|string',
        'lat' => 'required|numeric',
        'lng' => 'required|numeric',
        'views_count' => 'required|integer',
        'comments_count' => 'required|integer',
        'likes_count' => 'required|integer',

        ]);
        $event = new Event($request->all());
        $event->save();

// 44 a 45/58  cosa fatta in due modi diversi (creare un evento passando i parametri presi nel body)
        //$event = new Event();
        //$event->name = $request->name;
        //$event->description = $request->description;
        //$event->data = $request->data;
        //$event->cover_url = $request->cover_url;
        //$event->price = $request->price;
        //$event->address = $request->event;
        //$event->lat = $request->lat;
        //$event->lng = $request->lng;
        //$event->views_count = $request->views_count;
        //$event->comments_count = $request->comments_count;
        //$event->likes_count = $request->likes_count;
        //$event->save();

        return new EventResource($event);
    }
    public function update(Request $requesst, $id ){
        $this->validate($request, [

        'name' => 'required|min:3',
        'descriptio' => 'required|string',
        'date' => 'required|date',
        'cover_url' => 'required|url',
        'price' => 'required|numeric',
        'address' => 'required|string',
        'lat' => 'required|numeric',
        'lng' => 'required|numeric',
        'views_count' => 'required|integer',
        'comments_count' => 'required|integer',
        'likes_count' => 'required|integer',
        ] );
        $event = Event::find($id);
         //if($event){
           //  retutn $this->failure('evento specifico non esiste' , 1, 404);
         //}
        $even->name = $request->input(key:"name");
        $event->save();
        return new EventResource($event);
    }
}
