<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $table = 'feed_tbl';
    protected $fillable = ['title', 'body', 'image', 'source', 'publisher'];
    

}


?>