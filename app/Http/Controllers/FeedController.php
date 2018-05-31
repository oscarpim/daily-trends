<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feed;
use Goutte\Client;

class FeedController extends Controller
{
    
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
           if (!empty($insideFeed->filter('img')->eq(3))) {
                $imageMundoFeed[] = $insideFeed->filter('img')->eq(3)->attr('src');
           }else{
                $imageMundoFeed[] = '';
           }
            //fuente de articulo del Mundo
           $sourceMundoFeed[] = 'El Mundo';
            //editor de articulo del Mundo
           if (empty($insideFeed->filter('ul.author'))) {
                $publisherMundoFeed[] = $insideFeed->filter('ul.author')->text();
           }else{
                $publisherMundoFeed[] = '';
           }
            
            
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
           if (!empty($insideFeed->filter('img')->eq(2))) {
                $imagePaisFeed[] = $insideFeeds->filter('img')->eq(2)->attr('src');
           }else{
                $imagePaisFeed[] = '';
           }
            //fuente de articulo del Pais
           $sourcePaisFeed[] = 'El Pais';
            //editor de articulo del Pais
           if (!empty($insideFeeds->filter('span.autor-nombre > a'))) {
                $publisherPaisFeed[] = $insideFeeds->filter('span.autor-nombre > a')->text();
           }else{
                $publisherPaisFeed[] = '';
           }
            
        }
        
        //Ingresamos datos recogidos en la Base de Datos
        $feed = new Feed();
        $data=array();
        
        
        $data = array(
            //EL MUNDO
            array('title'=>$titulosMundoFeed[0], 'body'=> $bodyMundoFeed[0], 'image'=> $imageMundoFeed[0], 'source'=> $sourceMundoFeed[0], 'publisher'=> $publisherMundoFeed[0]),
            array('title'=>$titulosMundoFeed[1], 'body'=> $bodyMundoFeed[1], 'image'=> $imageMundoFeed[1], 'source'=> $sourceMundoFeed[1], 'publisher'=> $publisherMundoFeed[1]),
            array('title'=>$titulosMundoFeed[2], 'body'=> $bodyMundoFeed[2], 'image'=> $imageMundoFeed[2], 'source'=> $sourceMundoFeed[2], 'publisher'=> $publisherMundoFeed[2]),
            array('title'=>$titulosMundoFeed[3], 'body'=> $bodyMundoFeed[3], 'image'=> $imageMundoFeed[3], 'source'=> $sourceMundoFeed[3], 'publisher'=> $publisherMundoFeed[3]),
            array('title'=>$titulosMundoFeed[4], 'body'=> $bodyMundoFeed[4], 'image'=> $imageMundoFeed[4], 'source'=> $sourceMundoFeed[4], 'publisher'=> $publisherMundoFeed[4]),
            //EL PAIS
            array('title'=>$titulosPaisFeed[0], 'body'=> $bodyPaisFeed[0], 'image'=> $imagePaisFeed[0], 'source'=> $sourcePaisFeed[0], 'publisher'=> $publisherPaisFeed[0]),
            array('title'=>$titulosPaisFeed[1], 'body'=> $bodyPaisFeed[1], 'image'=> $imagePaisFeed[1], 'source'=> $sourcePaisFeed[1], 'publisher'=> $publisherPaisFeed[1]),
            array('title'=>$titulosPaisFeed[2], 'body'=> $bodyPaisFeed[2], 'image'=> $imagePaisFeed[2], 'source'=> $sourcePaisFeed[2], 'publisher'=> $publisherPaisFeed[2]),
            array('title'=>$titulosPaisFeed[3], 'body'=> $bodyPaisFeed[3], 'image'=> $imagePaisFeed[3], 'source'=> $sourcePaisFeed[3], 'publisher'=> $publisherPaisFeed[3]),
            array('title'=>$titulosPaisFeed[4], 'body'=> $bodyPaisFeed[4], 'image'=> $imagePaisFeed[4], 'source'=> $sourcePaisFeed[4], 'publisher'=> $publisherPaisFeed[4])
        );

        Feed::insert($data);
        $ultimasNoticias = Feed::orderBy('id', 'DESC')->get()->take(10);
        
        return view("feeds", ['ultimasNoticias'=>$ultimasNoticias]);
    }
    
}
?>