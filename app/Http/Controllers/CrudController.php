<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feed;
use Goutte\Client;

class CrudController extends Controller
{
    
    public function scraper(){
        
        $client = new Client();
        // Vamos al periodico el Mundo
        $elMundo = $client->request('GET', 'http://www.elmundo.es/');
        $elPais = $client->request('GET', 'http://elpais.com/');
        
        // Cogemos los ultimos posts de la portada del Mundo y mostramos los titulos
        $titulosMundo = array();
        $titulosMundo2 = array();
        $elMundo->filter('h2 > a')->each(function ($node) use (&$titulosMundo) {
             $titulosMundo[] = $node->text()."\n";
        });
        // Cogemos los ultimos posts de la portada del Pais y mostramos los titulos
        $titulosPais = array();
        $titulosPais2 = array();
        $elPais->filter('h2 > a')->each(function ($node) use (&$titulosPais) {
             $titulosPais[] = $node->text()."\n";
        });
        
        //Se almacenan 5 noticias en un segundo array para cada periodico y luego enviarlo a la vista
        $i=0;
        do{
           $titulosMundo2[$i]=$titulosMundo[$i]; 
           $titulosPais2[$i]=$titulosPais[$i];
           $i++;
        }while($i<5);
        
        return view("feeds", ["noticiasMundo" => $titulosMundo2, "noticiasPais" => $titulosPais2]);
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