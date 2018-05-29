<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feed;

class CrudController extends Controller
{
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