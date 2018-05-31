<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feed;
use Goutte\Client;

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
    
    public function read($id){
        
        $feed = Feed::where('id', $id)->get();
        return view('unico', ['feed' => $feed]);
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