<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feed;
use Goutte\Client;

class CrudController extends Controller
{
    
    public function scraper(){
        
        $client = new Client();
        // Vamos al periodico el Pais
        $elMundo = $client->request('GET', 'http://www.elmundo.es/');
        
        // Cogemos los ultimos posts de la portada y mostramos los titulos
        $titulosMundo = array();
        $elMundo->filter('h2 > a')->each(function ($node) use (&$titulosMundo) {
             $titulosMundo[] = $node->text()."<br><br>";
        });
        //Se almacenan en un array para luego mostrar el limite de 5 noticias que queremos
        $i=0;
        do{
           print $titulosMundo[$i]; 
           $i++;
        }while($i<5);
        
        
    }
    
    
    //Controladores CRUD del modelo Feed
    
    public function create(Request $request){
        
        $feed = new Feed();
        
        $feed -> title = $request -> title;
        $feed -> body = $request -> body;
        $feed -> image = $request -> image;
        $feed -> source = $request -> source;
        $feed -> publisher = $request -> publisher;
        
        $feed -> save();
        
        return redirect('/');
    }
    
    public function read(){
        
        $feeds = Feed::all();
        
        return view('feed.index', ['feeds' => $feeds]);
    }
    
    public function update(Requet $request, $id){
        
        $feed = Feed::findOrFail($id);
        
        $feed -> title = $request -> title;
        $feed -> body = $request -> body;
        $feed -> image = $request -> image;
        $feed -> source = $request -> source;
        $feed -> publisher = $request -> publisher;
        
        $feed -> save();
        
        return redirect('/');
    }
    
    public function delete($id){
        
        $feed = Feed::findOrFail($id);
        $feed -> delete();
        
        return redirect('/');
        
    }
}

?>