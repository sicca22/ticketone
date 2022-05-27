<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Http\Resources\UserResources;
use App\Http\Resources\UserCollection;

class UsersController extends Controller {
    public function __construct() {
    }
   
    public function create(Request $request) {
  
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:16',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'birthDate' => 'required|string',
            'city' => 'required|string',
            
        ]);

        // $request->all() serve per recuperare tutte le informazioni
        // presenti nel body della richiesta
        // Utilizzo new Event per initializzare un evento con tutte
        // le informazioni presenti nel body della richiesta (AKA params -> parametri della richiesta)
        $user = new User($request->all());
        $user->authToken = Str::random(60);
        $user->password = Hash::make($request->password);

        // La richista di salvataggio viene fatta al DB tramite Eloquent utilizzando PDO.
        $user->save();

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

        return new UserResources($user);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:16',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'birthDate' => 'required|string',
            'city' => 'required|string',
        ]);

        // Recupero l'evento che voglio modificare
        // usando l'ID passato nella URL
        $user = User::find($id);

        if (!$event) { // È true solo se l'oggetto non è null
           
        } else { // Vuol dire che l'oggetto non è stato trovato
            return $this->failure( 'The searched event does not exist', 1, 404);
        }
        $user->update($reuqest->all());
        return new UserResource($event);
    }
    
}