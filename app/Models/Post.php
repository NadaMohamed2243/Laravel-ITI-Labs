<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'description', 'user_id'];

    //link the post model to the user model
    public function user(){
        return $this->belongsTo(User::class);
    }

    //if i just change the function name and not follow the naming convention
    //i have to specify the foreign key
    public function postCreator(){
        return $this->belongsTo(User::class,'user_id');
    }
}
