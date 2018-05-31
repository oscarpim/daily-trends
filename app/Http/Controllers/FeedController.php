<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feed;
use Goutte\Client;

class FeedController extends Controller
{
    public function scraper(){
        
        $client = new Client();
        // Vamos al periodico el Mundo
        $elMundo = $client->request('GET', 'http://www.elmundo.es/');
        $elPais = $client->request('GET', 'http://elpais.com/');
        
        // Cogemos los ultimos posts de la portada del Mundo y mostramos los titulos
        $titulosMundo = array();
        $titulosMundo2 = array();
        $titulosPais = array();
        $titulosPais2 = array();
        $elMundo->filter('h2')->each(function ($node) use (&$titulosMundo) {
             $titulosMundo[] = $node->text()."\n";
        });
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
    
    
    
    public function insideLinks(){
        $client = new Client();
        
        //////////////////////////////
        /******DATOS EL MUNDO********/
        //////////////////////////////
        $elMundo = $client->request('GET', 'http://www.elmundo.es/');
         // Cogemos los links de las noticias del mundo
        $enlacesMundo = array();
        $enlacesMundo2 = array();
        $elMundo->filter('h2 > a')->each(function ($node) use (&$enlacesMundo) {
             $enlacesMundo[] = $node->attr('href');
        });
        
        // Almacenamos unicamente los 5 primeros
        $i=0;      
        do{
           $enlacesMundo2[$i]=$enlacesMundo[$i]; 
           $i++;
        }while($i<5);
        
        // Ingresamos link por link y obtenemos datos
        $titulosMundoFeed = array();
        $bodyMundoFeed = array();
        $imageMundoFeed = array();
        $sourceMundoFeed = array();
        $publisherMundoFeed = array();
        
        foreach($enlacesMundo2 as $en){
           $insideFeed = $client->request('GET', $en);
            //titulo de articulo del Mundo
           $titulosMundoFeed[] = $insideFeed->filter('div.titles > h1.js-headline')->text();
            //texto de articulo del Mundo
           $bodyMundoFeed[] = $insideFeed->filter('div.row.content.cols-70-30 > p')->text();
            //imagen de articulo del Mundo
           $insideFeed->filter('div.container-image > img.full-image')->each(function ($node) use (&$imageMundoFeed) {
             $imageMundoFeed[] = $node->attr('src');
            });
            //fuente de articulo del Mundo
           $sourceMundoFeed[] = 'El Mundo';
            //editor de articulo del Mundo
           $publisherMundoFeed[] = $insideFeed->filter('ul.author')->text();
            
            
        }
        
        //////////////////////////////
        /******DATOS EL PAIS********/
        //////////////////////////////
        $elPais = $client->request('GET', 'https://elpais.com/');
         // Cogemos los links de las noticias del mundo
        $enlacesPais = array();
        $enlacesPais2 = array();
        $elPais->filter('h2 > a')->each(function ($node) use (&$enlacesPais) {
             $enlacesPais[] = $node->attr('href');
        });
        
        // Almacenamos unicamente los 5 primeros
        $i=0;      
        do{
           $enlacesPais2[$i]=$enlacesPais[$i]; 
           $i++;
        }while($i<5);
        
        // Ingresamos link por link y obtenemos datos
        $titulosPaisFeed = array();
        $bodyPaisFeed = array();
        $imagePaisFeed = array();
        $sourcePaisFeed = array();
        $publisherPaisFeed = array();
        
        foreach($enlacesPais2 as $en){
           $insideFeeds = $client->request('GET', $en);
            //titulo de articulo del Pais
           $titulosPaisFeed[] = $insideFeeds->filter('h1#articulo-titulo.articulo-titulo')->text();
            //texto de articulo del Pais
           $bodyPaisFeed[] = $insideFeeds->filter('p')->eq(1)->text();
            //imagen de articulo del Pais
           $imagePaisFeed[]=$insideFeeds->filter('img')->eq(2)->attr('src');
            //fuente de articulo del Pais
           $sourcePaisFeed[] = 'El Pais';
            //editor de articulo del Pais
           $publisherPaisFeed[] = $insideFeeds->filter('span.autor-nombre > a')->text();
            
            
        }
        
        return view("feeds", ["titulosMundo" => $titulosMundoFeed, "textosMundo" => $bodyMundoFeed, "imagenesMundo" => $imageMundoFeed, "fuenteMundo" => $sourceMundoFeed, "editorMundo" => $publisherMundoFeed, "titulosPais" => $titulosPaisFeed, "textosPais" => $bodyPaisFeed, "imagenesPais" => $imagePaisFeed, "fuentePais" => $sourcePaisFeed, "editorPais" => $publisherPaisFeed]);
    }
    
}

?>